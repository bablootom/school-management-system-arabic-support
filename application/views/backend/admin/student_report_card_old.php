<style>
    .exam_chart {
    width           : 100%;
        height      : 265px;
        font-size   : 11px;
}
  
</style>
<script type="text/javascript">
    function printpage() {
        //Get the print button and put it into a variable
        var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        //printButton.style.visibility = 'hidden';
        //Print the page content
        window.print()
        //Set the print button to 'visible' again 
        //[Delete this line if you want it to stay hidden after printing]
        printButton.style.visibility = 'visible';
    }
</script>
<?php 
    $student_info = $this->crud_model->get_student_info($student_id);
    $exams         = $this->crud_model->get_exams();
    foreach ($student_info as $row1):
    foreach ($exams as $row2):
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary panel-shadow" data-collapsed="0">
            <!-- <div class="panel-heading">
                <div class="panel-title"><?php echo $row2['name'];?></div>
            </div> -->
            <div class="panel-body">
                <img width="100%" src="<?php echo base_url(); ?>assets/images/emp_header.jpg">

                <div class="col-md-6">
                    <!-- <img width="100%" src="<?echo base_url(); ?>assets/images/emp_header.jpeg"> -->
                    <!-- <?php print_r($exams) ?> -->
                    <div class="panel panel-info panel-shadow" data-collapsed="0">
                        <div class="panel-heading" align="center">
                            <h3>بيان درجات طالب</h3>
                            <h2>Statement of Student</h2>
                        </div>
                        <div>
                            <table class="table table-bordered">
                                    <tr>
                                        <td>رقم الملف</td>
                                        <td><?php echo $row1['student_code']; ?></td>
                                        <td>ID</td>
                                    </tr>
                                    <tr>
                                        <td>اسم الطالب/ـة</td>
                                        <td><?php echo $row1['name']; ?></td>
                                        <td>Student Name</td>
                                    </tr>
                                    <tr>
                                        <td>المستوى</td>
                                        <td><?php echo $row1['grade']; ?></td>
                                        <td>Grade</td>
                                    </tr>
                                    <tr>
                                        <td>رائد/ةالصف</td>
                                        <td>----</td>
                                        <td>Class Leader</td>
                                    </tr>
                                    <tr>
                                        <td><span>درجة النجاح في القرآن الكريم= </span> <strong>--/200</strong></td>
                                        <td><span>Pass Mark in Holy Quran = </span> <strong>--/200</strong></td>
                                    </tr>
                                    <tr>
                                        <td><span>درجة النجاح في المواد= 50% من النهاية الكبرى</span></td>
                                        <td><span>Pass Mark in Subjects = 50% of Max Mark</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">صدرت هذه الشهادة بتاريخ </td>
                                        <td colspan="2">This Certificate was issued in </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">أي كشط أو تعديل في محتوى هذه الوثيقة يلغيها</td>
                                        <td colspan="2">Any alteration to this certificate renders its validation</td>
                                    </tr>
                            </table>
                            
                        </div>
                    </div>
                </div>
               
               <div class="col-md-6">
                   <table class="table table-bordered">
                       <thead>
                        <tr>
                            <td style="text-align: center;">Subject</td>
                            <td style="text-align: center;">Mark</td>
                            <td style="text-align: center;">Highest</td>
                            <td style="text-align: center;">Grade</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $total_marks = 0;
                            $total_grade_point = 0;
                            $subjects = $this->db->get_where('subject' , array(
                                'class_id' => $class_id , 'year' => $running_year
                            ))->result_array();
                            //print_r($subjects);
                            foreach ($subjects as $row3):
                        ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $row3['name'];?></td>
                                <td style="text-align: center;">
                                    <?php
                                        $obtained_mark_query = $this->db->get_where('mark' , array(
                                                    'subject_id' => $row3['subject_id'],
                                                        'exam_id' => $row2['exam_id'],
                                                            'class_id' => $class_id,
                                                                'student_id' => $student_id , 
                                                                    'year' => $running_year));
                                        if ( $obtained_mark_query->num_rows() > 0) {
                                            $marks = $obtained_mark_query->result_array();
                                            //print_r($marks);
                                            foreach ($marks as $row4) {
                                                echo $row4['mark_obtained'];
                                                $total_marks += $row4['mark_obtained'];
                                            }
                                        }
                                    ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php

                                    $highest_mark = $this->crud_model->get_highest_marks( $row2['exam_id'] , $class_id , $row3['subject_id'] );
                                    echo $highest_mark;


        
                                    ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php
                                        if($obtained_mark_query->num_rows() > 0) {
                                            if ($row4['mark_obtained'] >= 0 || $row4['mark_obtained'] != '') {
                                                $grade = $this->crud_model->get_grade($row4['mark_obtained']);
                                                echo $grade['name'];
                                                $total_grade_point += $grade['grade_point'];
                                            }
                                        }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        <tr>
                            <td colspan="4"><?php echo get_phrase('total_marks');?> : <?php echo $total_marks;?></td>
                        </tr>
                        <tr>
                            <td colspan="4">A (100-90) / B (89-80) / C (79-70) / D (69-60) / E (59-50) / F (49-0)&#x200E;</td>
                        </tr>
                    </tbody>
                   </table>

                   <hr />

                   <?php echo get_phrase('total_marks');?> : <?php echo $total_marks;?>
                   <br>
                   <?php echo get_phrase('average_grade_point');?> : 
                        <?php 
                            $this->db->where('class_id' , $class_id);
                            $this->db->where('year' , $running_year);
                            $this->db->from('subject');
                            $number_of_subjects = $this->db->count_all_results();
                            echo ($total_grade_point / $number_of_subjects);
                        ?>

                    <br> <br>
                    <a onclick="printpage()" 
                        class="btn btn-primary">
                        <?php echo get_phrase('print_marksheet');?>
                    </a>
               </div>
            
            </div>
        </div>  
    </div>
</div>
<?php
    endforeach;
        endforeach;
?>