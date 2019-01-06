<?php  $form = $this->beginWidget('CActiveForm', get_form_list());?>
<div class="box">
    <div class="box-detail-tab">
        <ul class="c">
            <li class="current">班级考评</li>
        </ul>
    </div><!--box-detail-tab end-->
    <div class="box-content">
        <div class="box-header">
        </div><!--box-header end-->
        <div class="box-query">
            <form action="<?php echo Yii::app()->request->url;?>" method="get">
                <input type="hidden" name="r" value="<?php echo Yii::app()->request->getParam('r');?>">
                <label style="margin-right:10px;">
					<span style="margin-right: 150px"></span>
                    <span style="margin-right: 10px" >选择科目 : </span>
					 <?php echo CHtml::dropDownList('subjectSelection', "", 
					 array(0=>'请选择查询科目',1=>'语文',2=>'数学',3=>'英语',4=>'历史',5=>'生物',6=>'地理',7=>'物理',8=>'化学',9=>'政治'));
						?>					
                    <span style="margin-right: 50px"></span>
                    <span style="margin-right: 10px">选择年级 : </span>
                    <?php $yearData = (CHtml::listData(
					$model->findAll(
						array(
							"select" => array("entranceYear"),
							"distinct" => true,
						)),
						"entranceYear", "entranceYear"));
				echo Chtml::dropDownList('entranceYearSelection', '', $yearData, array(
						'empty' => '请选择年级',
						'id' => 'entranceYearSelection',
						'ajax' => array(
							'type' => 'POST',
							'url' => Yii::app()->createUrl("ClassEstimate/getClass"),
							'update' => '#classSelection',
							'data' => array('year' => 'js:$("#entranceYearSelection").val()'),
						)
					)
				);
				?>
					<span style="margin-right: 50px"></span>
					<span style="margin-right: 10px">选择学期 : </span>
					<?php echo CHtml::dropDownList('semesterSelection', '', array(0=>'请选择学期',1=>1, 2=>2)); ?>
                    <span style="margin-right: 20px"></span>				
                </label>					
				<div class="box-detail-submit">
					<?php echo
						'<button class="btn btn-blue" style="width: 200px;height: 50px;margin-left: -10%;" type="submit" formmethod="post" formaction="' . Yii::app()->createUrl("classEstimate/Query") .'">查询</button>'
					?>
				</div>
            </form>
        </div><!--box-search end-->
    </div><!--box-content end-->
</div><!--box end-->
<script>
    var deleteUrl = '<?php echo $this->createUrl('delete', array('id'=>'ID')); ?>';
</script>
<?php $this->endWidget(); ?>