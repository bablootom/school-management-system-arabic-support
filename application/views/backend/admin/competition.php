
            <a href="javascript:;" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_competition_add/');?>');" 
                class="btn btn-primary pull-right">
                <i class="entypo-plus-circled"></i>
            	<?php echo "Add New Competition"?>
            </a>
                <br><br>
                <!-- <?php echo base_url();?> -->
               <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th width="80"><?php echo get_phrase('id');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('link');?></div></th>
                         <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                $teachers	=	$this->db->get('competition')->result_array();
                                foreach($teachers as $row):?>
                        <tr>
                            <td><?php echo $row['id'];?>
                            </td>
                            <td><?php echo $row['name'];?></td>
                            <td><a target="_blank" href= <?php echo 'http://'.$row['link'];?> > <?php echo $row['link'];?></a>
                            	<!-- <a target="_blank" href= "<?php echo site_url('admin/competition_form'); ?>">Form</a></td> -->
                         <td>
                                
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                        
                                        
                                        <li>
                                        	<a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_edit_competition/'.$row['id']);?>');">
                                            	<i class="entypo-pencil"></i>
													<?php echo get_phrase('edit');?>
                                               	</a>
                                        				</li>
                                        <li class="divider"></li>
                                        
                                      
                                        <li>
                                        	<a href="#" onclick="confirm_modal('<?php echo site_url('admin/competition/delete/'.$row['id']);?>');">
                                            	<i class="entypo-trash"></i>
													<?php echo get_phrase('delete');?>
                                               	</a>
                                        				</li>
                                    </ul>
                                </div>
                                
                            </td> 
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		// var datatable = $("#table_export").dataTable({
		// 	"sPaginationType": "bootstrap",
		// 	"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
		// 	"oTableTools": {
		// 		"aButtons": [
					
		// 			{
		// 				"sExtends": "xls",
		// 				"mColumns": [1,2]
		// 			},
		// 			{
		// 				"sExtends": "pdf",
		// 				"mColumns": [1,2]
		// 			},
		// 			{
		// 				"sExtends": "print",
		// 				"fnSetText"	   : "Press 'esc' to return",
		// 				"fnClick": function (nButton, oConfig) {
		// 					datatable.fnSetColumnVis(0, false);
		// 					datatable.fnSetColumnVis(3, false);
							
		// 					this.fnPrint( true, oConfig );
							
		// 					window.print();
							
		// 					$(window).keyup(function(e) {
		// 						  if (e.which == 27) {
		// 							  datatable.fnSetColumnVis(0, true);
		// 							  datatable.fnSetColumnVis(3, true);
		// 						  }
		// 					});
		// 				},
						
		// 			},
		// 		]
		// 	},
			
		// });
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>

