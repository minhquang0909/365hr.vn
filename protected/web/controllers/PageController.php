<?php

    class PageController extends Controller
    {
        public function actionRecruitment_benefit(){
            $this->pageUrl = Yii::app()->createAbsoluteUrl('page/recruitment_benefit');
            $this->render('recruitment_benefit', array(

            ));
        }

        public function actionRecruitment_benefit_detail($id){
            $this->pageUrl = Yii::app()->createAbsoluteUrl('page/recruitment_benefit_detail',array('id'=>$id));
            $step = RecruitmentStep::model()->findByPk($id,'status=:status',array(
                ':status'   =>  News::NEWS_ACTIVE
            ));
            if ($step) {
                $step->views += 1;
                $step->update();
                //$stepData
                $stepData = RecruitmentStepLang::model()->find('parent_id=:parent_id AND language_id=:language_id', array(
                    ':parent_id' =>  $step->id,
                    ':language_id' =>  Yii::app()->session['language_id'],
                ));
                $this->pageTitle = isset($stepData['question'])?$stepData['question']:"";
                $this->render('recruitment_benefit_detail', array(
                    'step'         => $step,
                    'stepData'         => $stepData,
                ));
            }else{
                throw new CHttpException(404, Yii::t('web/app','The requested page does not exist'));
            }
        }

        public function actionAbout(){
            $this->pageUrl = Yii::app()->createAbsoluteUrl('page/about');
            $this->render('about', array(

            ));
        }
        public function actionJobDetails(){
            $this->pageUrl = Yii::app()->createAbsoluteUrl('page/jobDetails');
            $this->render('job_details', array(

            ));
        }
        public function actionQa(){
            $this->pageUrl = Yii::app()->createAbsoluteUrl('page/qa');
            $qa_categories = QACategories::getAll();
            $this->render('qa', array(
                'qa_categories'    =>  $qa_categories,
            ));
        }

        /**
         *Action news detail
         *
         * @param $id
         */
        public function actionDetail($id)
        {
            $this->pageUrl = Yii::app()->createAbsoluteUrl('page/detail');
            $page = StaticPage::model()->findByPk($id,'status=:status',array(
                ':status'   =>  StaticPage::NEWS_ACTIVE
            ));
            if ($page) {
                $page->views += 1;
                $page->update();
                //page lang
                $pageData = StaticPageLang::model()->find('parent_id=:parent_id AND language_id=:language_id', array(
                    ':parent_id' =>  $page->id,
                    ':language_id' =>  Yii::app()->session['language_id'],
                ));
                $this->render('detail', array(
                    'page'         => $page,
                    'pageData'         => $pageData,
                ));
            }else{
                throw new CHttpException(404, Yii::t('web/app','The requested page does not exist'));
            }
        }
    } //end class