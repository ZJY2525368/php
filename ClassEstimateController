<?php

class ClassEstimateController extends CController
{
    public function actionIndex()
    {
        $data=array();
        $data['model']=new Student();
        $this->render('index',$data);
    }


    public function actionQuery(){
        try {
            set_cookie('_currentUrl_', Yii::app()->request->url);
            Yii::app()->getRequest()->redirect(
                Yii::app()->createUrl("ClassEstimate/QueryRanking",
                    array(
                        'subjectSelection' => $_POST['subjectSelection'],
                        'entranceYearSelection' => $_POST['entranceYearSelection'],
                        'semesterSelection' => $_POST['semesterSelection'],
                    )
                )
            );
        }catch (Exception $exception){
            del_cookie('_currentUrl_');
            self::alert("内部错误，文件".__FILE__."行:".__LINE__);
            Yii::app()->getRequest()->redirect(Yii::app()->createUrl("ClassEstimate/index"));
        }
        //$this->actionRegisterEachStudent();
    }

    public function actionQueryRanking(){
        if (Yii::app()->request->isPostRequest) {
            $model=new Grade();
            $model->attributes = $_POST['Grade'];
            $goto = $this->createUrl("ClassEstimate/QueryRanking", array(
                "entranceYearSelection" => (int)date("Y")-$model->year+1,
                "semesterSelection" => $model->semester,
            ));
        }

        $subjectSel = Yii::app()->request->getParam('subjectSelection');
        $yearSel = Yii::app()->request->getParam('entranceYearSelection');
        $semesterSel = Yii::app()->request->getParam('semesterSelection');

        $Classes = $this->getWholeClass($yearSel);
        $gradeDate=array();
        foreach($Classes as $class){
            $gradeDate=array(
                'condition'=>array(
                    'year'=>$yearSel,
                    'semester'=>$semesterSel,
                    'class'=>$class,
                    'subject'=>$subjectSel
                ),
                'class_ave'=>array(
                    'ave'=>$this->getClassAverage($yearSel,$semesterSel,$class,$subjectSel),
                )
            );
        }
        $this->render('Ranking',$gradeDate);
    }
    //获得某年级某班级某个学期的某个学科的平均分
    public function getClassAverage($year,$semester,$class,$subject){

        $data=Yii::app() -> db -> createCommand()
            ->select("avg($subject) as avgGrade")
            ->from("grade")
            ->join("student","grade.id=student.id")
            ->where("entranceYear=$year AND semester=$semester AND class=$class")
            -> queryRow();

        $find=$data['avgGrade'];
        return $find;

    }
	
	//获得某年级的所有班级
	public function getWholeClass($year){
		$find=Yii::app() -> db -> createCommand()
            ->select ("class")
            ->from("Student")
            ->where("entranceYear=$year")
            ->queryRow();

		$Classes=$find;
		return $Classes;
	}

    //如果数据库中有，就返回，如果没有，就新建一个
    private function getGradeModel($id,$semester,$year){
        $cri=new CDbCriteria();
        $cri->condition="id={$id} and year={$year} and semester={$semester}";
        /*
        exit();
        */
        $find=Grade::model()->findAll($cri);
        if($find==null||count($find)==0){
            $model=new Grade();
            $model->setMe($id,$year,$semester);
            //$model->setMe($studentsInTheClass[$studentCurr]->attributes['id'],$_GET['semesterSelection'],(int)date("Y")-(int)$yearSel+1);
            return $model;
        }
        else{
            return $find[0];
        }
    }

    static public function alert($mes){
        echo '
			<script>alert("'.$mes.'")</script>
		';
    }

    // Uncomment the following methods and override them if needed
    /*
    public function filters()
    {
        // return the filter configuration for this controller, e.g.:
        return array(
            'inlineFilterName',
            array(
                'class'=>'path.to.FilterClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }
    public function actions()
    {
        // return external action classes, e.g.:
        return array(
            'action1'=>'path.to.ActionClass',
            'action2'=>array(
                'class'=>'path.to.AnotherActionClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }
    */
}
