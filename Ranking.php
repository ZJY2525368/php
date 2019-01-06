<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/12/18
 * Time: 0:32
 */
?>
<?php  $form = $this->beginWidget('CActiveForm', get_form_list());?>
<div class="box">
    <div class="box-detail-tab">
        <ul class="c">
            <li class="current">班级考评</li>
        </ul>
    </div><!--box-detail-tab end-->
	<div>

	</div>
        <div class="box-table">
            <table class="list">
                <thead>
                <tr>
					<th>年级</th>
                    <th>班级考评排名</th>
                    <th>班级</th>
                    <th>班级平均分</th> 
                </tr>
                </thead>
                <tbody>
                <?php
                $num = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15);
                $number = 15;
                for($i=1; $i<$number+1; $i++){?>
                <tr>
					<td width="20%"><?php echo $condition['year'].'级'?></td>
                    <td width="20%"><?php echo $i?></td>
                    <td width="25%"><?php echo '( '.$condition['class'].' ) 班'?></td>
                    <td width="25%"><?php echo $class_ave['ave']?></td>          
                </tr>
                <?php } ?>

                </tbody>
            </table>
        </div><!--box-table end-->
    </div><!--box-content end-->
</div><!--box end-->
<script>
    var deleteUrl = '<?php echo $this->createUrl('delete', array('id'=>'ID')); ?>';
</script>
<?php $this->endWidget(); ?>
