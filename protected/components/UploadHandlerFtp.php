<?php

    class UploadHandlerFtp extends qqFileUploader
    {
        public function handleUpload($uploadDirectory, $name = null)
        {

            if (is_writable($this->chunksFolder) && 1==mt_rand(1, 1 / $this->chunksCleanupProbability)) {

                // Run garbage collection
                $this->cleanupChunks();
            }

            // Check that the max upload size specified in class configuration does not
            // exceed size allowed by server config
            if ($this->toBytes(ini_get('post_max_size')) < $this->sizeLimit || $this->toBytes(ini_get('upload_max_filesize')) < $this->sizeLimit) {
                $size = max(1, $this->sizeLimit / 1024 / 1024).'M';

                return array('error' => "Server error. Increase post_max_size and upload_max_filesize to ".$size);
            }

            // is_writable() is not reliable on Windows (http://www.php.net/manual/en/function.is-executable.php#111146)
            // The following tests if the current OS is Windows and if so, merely checks if the folder is writable;
            // otherwise, it checks additionally for executable status (like before).

            $isWin              = (strtoupper(substr(PHP_OS, 0, 3))==='WIN');
            if(!$this->uploadFtp){
                $folderInaccessible = ($isWin) ? !is_writable($uploadDirectory) : (!is_writable($uploadDirectory) && !is_executable($uploadDirectory));

                if ($folderInaccessible) {
                    return array('error' => "Server error. Uploads directory isn't writable".(!$isWin) ? " or executable." : ".");
                }
            }
            if (!isset($_SERVER['CONTENT_TYPE'])) {
                return array('error' => "No files were uploaded.");
            } else if (strpos(strtolower($_SERVER['CONTENT_TYPE']), 'multipart/')!==0) {
                return array('error' => "Server error. Not a multipart request. Please set forceMultipart to default value (true).");
            }

            // Get size and name

            $file = $_FILES[$this->inputName];
            $size = $file['size'];

            if ($name===null) {
                $name = $this->getName();
            }

            // Validate name

            if ($name===null || $name==='') {
                return array('error' => 'File name empty.');
            }

            // Validate file size

            if ($size==0) {
                return array('error' => 'File is empty.');
            }

            if ($size > $this->sizeLimit) {
                return array('error' => 'File is too large.');
            }

            // Validate file extension

            $pathinfo = pathinfo($name);
            $ext      = isset($pathinfo['extension']) ? $pathinfo['extension'] : '';

            if ($this->allowedExtensions && !in_array(strtolower($ext), array_map("strtolower", $this->allowedExtensions))) {
                $these = implode(', ', $this->allowedExtensions);

                return array('error' => 'File has an invalid extension, it should be one of '.$these.'.');
            }

            // Save a chunk

            $totalParts = isset($_REQUEST['qqtotalparts']) ? (int)$_REQUEST['qqtotalparts'] : 1;

            if ($totalParts > 1) {

                $chunksFolder = $this->chunksFolder;
                $partIndex    = (int)$_REQUEST['qqpartindex'];
                $uuid         = $_REQUEST['qquuid'];

                if (!is_writable($chunksFolder) && !is_executable($uploadDirectory)) {
                    return array('error' => "Server error. Chunks directory isn't writable or executable.");
                }

                $targetFolder = $this->chunksFolder.DIRECTORY_SEPARATOR.$uuid;

                if (!file_exists($targetFolder)) {
                    mkdir($targetFolder);
                }

                $target  = $targetFolder.'/'.$partIndex;
                $success = move_uploaded_file($_FILES[$this->inputName]['tmp_name'], $target);

                // Last chunk saved successfully
                if ($success AND ($totalParts - 1==$partIndex)) {

                    $target           = $this->getUniqueTargetPath($uploadDirectory, $name);
                    $this->uploadName = basename($target);

                    $target = fopen($target, 'wb');

                    for ($i = 0; $i < $totalParts; $i++) {
                        $chunk = fopen($targetFolder.DIRECTORY_SEPARATOR.$i, "rb");
                        stream_copy_to_stream($chunk, $target);
                        fclose($chunk);
                    }

                    // Success
                    fclose($target);

                    for ($i = 0; $i < $totalParts; $i++) {
                        unlink($targetFolder.DIRECTORY_SEPARATOR.$i);
                    }

                    rmdir($targetFolder);

                    return array("success" => true);

                }

                return array("success" => true);

            } else {
                //Upload with ftp
                if($this->uploadFtp) {

                    $target = $this->getUniqueFilename_Ftp($name);
                   /* echo $uploadDirectory;                    echo '<p>'.$file['tmp_name'];                    echo '<p>'.$this->uploadName;                    echo '<p>'.$target;                    die;*/
                    if ($target) {
                        $this->uploadName = basename($target);
                        $ftp = Yii::app()->ftp;
                        $rs  = $ftp->upload($uploadDirectory, $file['tmp_name'], $target);

                        if ($rs) {
                            return array('success' => true);
                        }
                        return array(
                            'error' => 'Could not save uploaded file.'.'The upload was cancelled, or server error encountered',
                        );

                    }

                }else{
                    $target = $this->getUniqueTargetPath($uploadDirectory, $name);
                    if ($target) {
                        $this->uploadName = basename($target);

                        if (move_uploaded_file($file['tmp_name'], $target)) {
                            return array('success' => true);
                        }
                    }

                    return array(
                        'error' => 'Could not save uploaded file.'.'The upload was cancelled, or server error encountered',
                    );
                }
            }
        }

        /**
         * Get the name of the uploaded file
         */
        public function getUploadName()
        {
            return $this->uploadName;
        }
    }
