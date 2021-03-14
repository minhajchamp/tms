$(document).ready(function(){

	$.each(user_module,function(k,v){
		if(v.modules_icon != null){
			var active_class = (v.modules_slug == uri_segment1)?'current-page':'';
			var html = '';
			html  += '<li class="'+active_class+'">';
			html  +=     '<a href="'+base_url+v.modules_slug+'"><i class="'+v.modules_icon+'"></i> '+v.modules_name+'</a>';
			html  += '</li>';
			$('.side-menu').append(html);
		}
	});





	var changepwstate = "hide";
	$('.changepwbtn').on("click",function(){
		if(changepwstate == "hide")
		{
			$('.changepwbtn').text('Cancel');
			$('.changepwbtn').addClass('btn-danger');
			$('.changepwbtn').removeClass('btn-success');
			$('.changepw').fadeIn();
	 		changepwstate = "show";
		}
		else
		{
			$('.changepw input').val('');
			$('.changepwbtn').text('Change Password');
			$('.changepwbtn').removeClass('btn-danger');
			$('.changepwbtn').addClass('btn-success');
			$('.changepw').fadeOut();
			changepwstate = "hide";
		}
	});


	$('.image_upload').on('change',function(){
		var files = $(this).files[0];
		console.log(files);
	});

	var i = 1;

	$('.addschools').on('click',function(){
		var html = '<div class="item-main"> <hr> <div class="item form-group "> <label class="control-label col-md-3 col-sm-3 col-xs-12">School Name<span class="required">*</span> </label> <div class="col-md-6 col-sm-6 col-xs-12"> <input type="text" class="form-control col-md-7 col-xs-12" name="schooldata['+i+'][school_name]" required="required" value=""> <div style="color:red"></div></div></div><div class="form-group"> <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">School Logo</label> <div class="col-md-6 col-sm-6 col-xs-12"> <div class="dropzone-cust dropzone-cust-multiple" data-dz-url="'+base_url+'index.php/school/file_upload" data-dz-file-array="schooldata" data-dz-file-array-index="'+i+'" data-dz-file-name="school_logo"> </div></div></div><div class="item form-group "> <label class="control-label col-md-3 col-sm-3 col-xs-12">School Port Reference<span class="required">*</span> </label> <div class="col-md-6 col-sm-6 col-xs-12"> <input type="text" class="form-control col-md-7 col-xs-12" name="schooldata['+i+'][school_port_reference]" required="required" value=""> <div style="color:red"></div></div></div><div class="item form-group "> <label class="control-label col-md-3 col-sm-3 col-xs-12">School Contact No<span class="required">*</span> </label> <div class="col-md-6 col-sm-6 col-xs-12"> <input type="text" class="form-control col-md-7 col-xs-12" name="schooldata['+i+'][school_contact_no]" required="required" value=""> <div style="color:red"></div></div></div><div class="item form-group "> <label class="control-label col-md-3 col-sm-3 col-xs-12">School Email<span class="required">*</span> </label> <div class="col-md-6 col-sm-6 col-xs-12"> <input type="text" class="form-control col-md-7 col-xs-12" name="schooldata['+i+'][school_email]" required="required" value=""> <div style="color:red"></div></div></div><div class="item form-group "> <label class="control-label col-md-3 col-sm-3 col-xs-12">School Address<span class="required">*</span> </label> <div class="col-md-6 col-sm-6 col-xs-12"> <textarea class="form-control col-md-7 col-xs-12" name="schooldata['+i+'][school_address]" required="required" value=""></textarea> <div style="color:red"></div></div></div></div>';

		$('form').append(html);
		dzInit();
		i++;
	});




	$('.addproducts').on('click',function(){
		var html = '<div class="item form-group "> <hr>  <label class="control-label col-md-3 col-sm-3 col-xs-12" >Product Name<span class="required">*</span> </label> <div class="col-md-6 col-sm-6 col-xs-12"> <input type="text" class="form-control col-md-7 col-xs-12" name="productdata['+i+'][product_name]" required="required" value=""> <div style="color:red"></div></div></div><div class="item form-group "> <label class="control-label col-md-3 col-sm-3 col-xs-12" >Product Version<span class="required">*</span> </label> <div class="col-md-6 col-sm-6 col-xs-12"> <input type="text" class="form-control col-md-7 col-xs-12" name="productdata['+i+'][product_version]" required="required" value=""> <div style="color:red"></div></div></div><div class="form-group"> <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product Logo</label> <div class="col-md-6 col-sm-6 col-xs-12"> <div class="dropzone-cust dropzone-cust-multiple" data-dz-url="'+base_url+'product/file_upload" data-dz-file-array="productdata" data-dz-file-array-index="'+i+'" data-dz-file-name="product_logo"> </div></div></div>';
		
		$('form').append(html);
		dzInit();
		i++;
	});

	$('.adddepartments').on('click',function(){
		var html = ' <div class="item-main"><hr> <div class="item form-group "> <label class="control-label col-md-3 col-sm-3 col-xs-12" >Department Name<span class="required">*</span> </label> <div class="col-md-6 col-sm-6 col-xs-12"> <input type="text" class="form-control col-md-7 col-xs-12" name="departmentdata['+i+'][department_name]" required="required" value=""> <div style="color:red"></div></div></div></div>';
		
		$('form').append(html);
		i++;
	});





	$('.addcampuses').on('click',function(){
		var html = '<div class="item-main"> <hr> <div class="item form-group "> <label class="control-label col-md-3 col-sm-3 col-xs-12">Campus Name<span class="required">*</span> </label> <div class="col-md-6 col-sm-6 col-xs-12"> <input type="text" class="form-control col-md-7 col-xs-12" name="campusdata['+i+'][campus_name]" required="required" value=""> <div style="color:red"></div></div></div><div class="form-group"> <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Campus Logo</label> <div class="col-md-6 col-sm-6 col-xs-12"> <div class="dropzone-cust dropzone-cust-multiple" data-dz-url="'+base_url+'index.php/campus/file_upload" data-dz-file-array="campusdata" data-dz-file-array-index="'+i+'" data-dz-file-name="campus_logo"> </div></div></div><div class="item form-group "> <label class="control-label col-md-3 col-sm-3 col-xs-12">Campus Port Reference<span class="required">*</span> </label> <div class="col-md-6 col-sm-6 col-xs-12"> <input type="text" class="form-control col-md-7 col-xs-12" name="campusdata['+i+'][campus_port_reference]" required="required" value=""> <div style="color:red"></div></div></div><div class="item form-group "> <label class="control-label col-md-3 col-sm-3 col-xs-12">Campus Contact No<span class="required">*</span> </label> <div class="col-md-6 col-sm-6 col-xs-12"> <input type="text" class="form-control col-md-7 col-xs-12" name="campusdata['+i+'][campus_contact_no]" required="required" value=""> <div style="color:red"></div></div></div><div class="item form-group "> <label class="control-label col-md-3 col-sm-3 col-xs-12">Campus Email<span class="required">*</span> </label> <div class="col-md-6 col-sm-6 col-xs-12"> <input type="text" class="form-control col-md-7 col-xs-12" name="campusdata['+i+'][campus_email]" required="required" value=""> <div style="color:red"></div></div></div><div class="item form-group "> <label class="control-label col-md-3 col-sm-3 col-xs-12">Campus Address<span class="required">*</span> </label> <div class="col-md-6 col-sm-6 col-xs-12"> <textarea class="form-control col-md-7 col-xs-12" name="campusdata['+i+'][campus_address]" required="required" value=""></textarea> <div style="color:red"></div></div></div></div>';
		$('form').append(html);
		dzInit();
		i++;
	});


	$('.addmodules').on('click',function(){
		var html = '<div class="item form-group ">  <hr> <label class="control-label col-md-3 col-sm-3 col-xs-12" >Module Name<span class="required">*</span> </label> <div class="col-md-6 col-sm-6 col-xs-12"> <input type="text" class="form-control col-md-7 col-xs-12" name="moduledata['+i+'][module_name]" required="required" value=""> <div style="color:red"></div></div></div>';
		$('form').append(html);
		dzInit();
		i++;
	});



 

	$('body').on('click','.remove_btn',function(){
		$(this).parents('.item-main').remove();
	});


	// $(".dropzone-cust").dropzone({ 
	// 	url: base_url+"index.php/user_profile/file_upload",
	// 	complete : function(response){
	// 		console.log(response.xhr.response);
	// 		//$(this)[0].previewsContainer.innerHTML = '';
	// 		//console.log($(this)[0].previewsContainer);
	// 	}
	// });


	dzInit();

	function dzInit(){
		$("body").find('.dropzone-cust').each(function(){
			var _this = $(this);
			var url = _this.data('dz-url');
			if(_this.find('.help-text').length == 0){
				_this.append('<p class="help-text"><i class="fa fa-cloud-upload"></i> Drop file here or click here to upload..</p>');
			}

			var file_name = _this.data('dz-file-name');

			if(_this.hasClass('dropzone-cust-multiple')){
				var 	file_name = _this.data('dz-file-array')+'['+_this.data('dz-file-array-index')+']['+_this.data('dz-file-name')+']';
			}

			if(!_this.hasClass('dz-clickable')){
				_this.dropzone({ 
				maxFiles : 1,
				maxFilesize: 100,

 				acceptedFiles : ".zip,.rar,.png,.jpg,.jpeg,.xls,.xlsx,.doc,.docx,.pdf,.exe",
                init: function(){
                    this.on("error", function(file, errorMessage) {
                        this.removeAllFiles(true); 
                    });

                    this.on("maxfilesexceeded", function(file){
				        alert("No more files please!");
				    });

                },				
				url: url,
					success : function(response){
						var response_file_name = response.xhr.response.split('.');
						var file_extention = response_file_name[response_file_name.length - 1];
						var file_type = response.type.split('/');
						if(file_type[0] == 'image'){
							_this.children('.dz-image').remove();
							_this.html('<input type="hidden" name="'+file_name+'" value="'+response.xhr.response+'">'+_this.html());
						}
						else{
							_this.find('.dz-image').remove();
							_this.find('.dz-details').show();
							_this.children('.dz-image').html(response.xhr.response);
							_this.html('<input type="hidden" name="'+file_name+'" value="'+response.xhr.response+'">'+_this.html());
						}
					}
				});
			}
			
		});
	}

	$('body').find('.editor').each(function(){
		new Jodit('.editor');
	});

	// DASHBOARD
	$('#department_id').on('change',function(){
		val = $(this).val();
		var j = 0;
		$('#user_id').val('');

		$('#user_id .options').addClass('hidden');

		$('#user_id .options').each(function(){
			if($(this).data('department-id') == val){
				j++;
				$(this).removeClass('hidden');
			}
			if(j > 0){
				$('.user_selection').slideDown();
			}
			else{
				$('.user_selection').slideUp();
			}
		});
	});


	$('#product_id').on('change',function(){
		val = $(this).val();

		console.log(val);
		var j = 0;
		$('#module_id').val('');

		$('#module_id .options').addClass('hidden');

		$('#module_id .options').each(function(){
			if($(this).data('product-id') == val){
				j++;
				$(this).removeClass('hidden');
			}
			if(j > 0){
				$('.module_selection').slideDown();
			}
			else{
				$('.module_selection').slideUp();
			}
		});
	});


	$('#school_id').on('change',function(){
		val = $(this).val();
		var school_port_reference = $(this).find(':selected').attr('data-school-port-reference');
		
		$('#newTicketModal #school_port_reference').text('');
		$('#newTicketModal #campus_port_reference').text('');
		$('#newTicketModal #school_port_reference').text(school_port_reference);

		var j = 0;
		$('#campus_id').val('');

		$('#campus_id .options').addClass('hidden');

		$('#campus_id .options').each(function(){
			if($(this).data('school-id') == val){
				j++;
				$(this).removeClass('hidden');
			}
			if(j > 0){
				$('.campus_selection').slideDown();
			}
			else{
				$('.campus_selection').slideUp();
			}
		});
	});

	$('#campus_id').on('change',function(){
		var campus_port_reference = $(this).find(':selected').attr('data-campus-port-reference');		
		$('#newTicketModal #campus_port_reference').text('');
		$('#newTicketModal #campus_port_reference').text(campus_port_reference);
	});





	$(function() {
	  $('input[type="datetimepicker"]').daterangepicker({
	    locale: {
		  format: 'YYYY-MM-DD hh:mm:ss'
		},
		timePicker: true,
		timePicker24Hour: true,
	    singleDatePicker: true,
	    showDropdowns: true,
	    minYear: 1901,
	    maxYear: parseInt(moment().format('YYYY'),10)
	  }, function(start, end, label) {
	    var years = moment().diff(start, 'years');
	    //alert("You are " + years + " years old!");
	  });
	});	




	$('.addTicket .submitBtn').on('click',function(e){
		e.preventDefault();
		var formdata = $('.addTicket').serializeArray();


		var formIsValid = $("#demo-form2").parsley().isValid();
		if(formIsValid == true){
			$.ajax({
				url : base_url+'dashboard/submit_ticket',
				type: 'post',
				data: formdata,
				success: function(response){
					if(response == 'true'){
						getTickets();
						$('#newTicketModal').modal('hide');
						$('body').find('.modal-backdrop').remove();
					}
				} 
			});
		}
	});

	$('.tile_stats_count').on('click',function(e){
		e.preventDefault();
		var ticketing_current_status = $(this).attr('data-status');
		if(ticketing_current_status == 'all'){
			getTickets();
		}else{
			data = {limit:5,offset:0,method:'add',ticketing_current_status:ticketing_current_status};
			getTickets(data);
		}
		$('.loadMoreTicket').attr('data-offset' , 5);
		$('.loadMoreTicket').attr('data-status' , ticketing_current_status);
	});

	$('.loadMoreTicket').on('click',function(e){
		e.preventDefault();
		var ticketing_current_status = $(this).attr('data-status');
		var offset = $(this).attr('data-offset');

		if(ticketing_current_status == 'all'){
			data = {limit:5,offset:offset,method:'append'};
		}

		else{
			if(ticketing_current_status != ''){				
				data = {limit:5,offset:offset,method:'append',ticketing_current_status:ticketing_current_status};
			}
		}
		getTickets(data);
		var newoffset = parseInt(offset) + 5;
		var offset = $(this).attr('data-offset' , newoffset);
	});

	getTickets();

	function getTickets(data = '',animate = true){
		if(data != ''){
			data = data;
		}
		else{
			data = {limit:5,offset:0,method:'add'};
		}
		$.ajax({
			url: base_url+'dashboard/get_tickets',
			type: 'post',
			data: data,
			success: function(response){
				if(data.method == 'add'){
					$('.ticket-main').html('');
					appendTickets(response.ticketing_data,animate);
				}
				else if(data.method == 'append'){
					appendTickets(response.ticketing_data,animate);
				}	

			},
			dataType: 'JSON'
		});
	}


	$('#searchTicket').on('keyup',function(){
		query = $(this).val();
		if(query != ''){
			$('.loadMoreTicket').fadeOut();
			data = {search:query,method:'add'}
			getTickets(data,false);	
		}
		else{
			data = {limit:5,offset:0,method:'add'};
			getTickets(data,false);
			$('.loadMoreTicket').fadeIn();
		}
	});



	function appendTickets(response,animate = false){
		var html = '';
		$.each(response, function(k,v){
			var ticket_created_at = dateFormat(v.ticketing_activity_at, "dddd, mmmm dS, yyyy, h:MM:ss TT");
			var assigned_to_user_at = '';

			//console.log(v.assigned_to_user_at);

			if(v.assigned_to_user_at != null){
				var assigned_to_user = '';
				if(v.assigned_to_user_id != null){
					if(v.assigned_to_user_id == user_id){
						assigned_to_user = 'you';
					}
					else{
						assigned_to_user = v.assigned_to_user_name;
					}
				}
				assigned_to_user_at_time = dateFormat(v.assigned_to_user_at, "dddd, mmmm dS, yyyy, h:MM:ss TT");
				assigned_to_user_at = '<small> | <b>Assigned to '+assigned_to_user+' at:</b> '+assigned_to_user_at_time+'</small>';

			}
			var ticket_created_at = dateFormat(v.ticketing_activity_at, "dddd, mmmm dS, yyyy, h:MM:ss TT");
			var port_reference = (v.campus_port_reference != '')?v.campus_port_reference : v.school_port_reference;
			var module_name = (v.module_name != null)?'<p><b>Module:</b> '+v.module_name+'</p>': '';
			var html = '';
			html += '<a href="#" data-ticket-id="'+v.ticketing_id+'" class="ticketShowBtn">';
			html += '<div class="ticket ticketing_id_'+v.ticketing_id+' status_'+v.ticketing_current_status+'">';
			html += '    <div class="middle-bar">';
			html += '        <div class="">';
			html += '            <h4><b><i class="fa fa-ticket"></i> Ticket #'+v.ticketing_id+'</b> <span class="'+v.ticketing_current_status+'">('+v.ticketing_current_status.replace('_',' ')+')</span>: '+v.ticketing_titile+'</h4>';
			html += '        </div>';
			html += '	     <div class="ticket_timestamp">';
			html += '           <small><b>Created at:</b> '+ticket_created_at+'</small>'+assigned_to_user_at;
			html += '	     </div>';
			html += '    </div>';
			html += '    <div class="bottom-bar">';
			html += '	    <div class="ticket-info-cont">';
			html += '			<div class="ticket-sm-info no-border">';
			html += '	            <p><b>Priority:</b> <b><span class="priority"><span class="label priority_'+v.priority+'" >'+v.priority+'</span></span></b></p>';
			html += '	        </div>';
			html += '	        <div class="ticket-sm-info">';
			html += '	            <p><b>Min Resolve Time:</b> <span class="label label-warning ticketing_min_resolve_time"></span></p>';
			html += '	        </div>';
			html += '	        <div class="ticket-sm-info">';
			html += '	            <p><b>Max Resolve Time:</b> <span class="label label-danger ticketing_max_resolve_time"></span></p>';
			html += '	        </div>';
			html += '			<div class="ticket-sm-info">';
			html += '	            <p><b>Type:</b> '+v.ticketing_query_type+'</p>';
			html += '	        </div>';			
			html += '			<div class="ticket-sm-info">';
			html += '	            <p><b>School:</b> '+v.school_name+'</p>';
			html += '	        </div>';
			html += '	        <div class="ticket-sm-info no-border">';
			html += '	            <p><b>Campus:</b> '+v.campus_name+'</p>';
			html += '	        </div>';
			html += '	        <div class="ticket-sm-info">';
			html += '	            <p><b>Port:</b> '+port_reference+'</p>';
			html += '	        </div>';
			html += '	        <div class="ticket-sm-info no-border">';
			html += '	            <p><b>Generated by:</b> '+v.generated_by_user_name+'</p>';
			html += '	        </div>';						
			html += '	        <div class="ticket-sm-info">';
			html += '	            <p><b>Product:</b> '+v.product_name+'</p>';
			html += '	        </div>';
			html += '	        <div class="ticket-sm-info ">';
			html += '	            '+module_name;
			html += '	        </div>';
			html += '	        <div class="ticket-sm-info ">';
			html += '	            ';
			html += '	        </div>';
			html += '	        <div class="ticket-sm-info ">';
			html += '	            ';
			html += '	        </div>';
			html += '	    </div>';
			html += '    </div>';
			html += '</div>';

			html += '</a>';

			ticketing_min_resolve_time = new Date(v .ticketing_min_resolve_time); 
			ticketing_max_resolve_time = new Date(v .ticketing_max_resolve_time); 			

			if(animate == false){
				$('.ticket-main').append(html);
			}			
			else if(animate == true){
				$(html).hide().appendTo('.ticket-main').show('slow');
			}

			var div_id =  '.ticketing_id_'+v.ticketing_id + ' .ticketing_min_resolve_time';
			$('.ticket-main').find(div_id).countdown({until: ticketing_min_resolve_time, compact: true, description:''});

			var div_id =  '.ticketing_id_'+v.ticketing_id + ' .ticketing_max_resolve_time';
			$('.ticket-main').find(div_id).countdown({until: ticketing_max_resolve_time, compact: true, description:''});
		});

		
	}


	function  appendComments(response,animate = false){
		$.each(response, function(k,v){

			var html = '';
			var username = (v.user_id == user_id)?'You':v.user_name;
			var datetime = dateFormat(v.ticketing_media_activity_at, "dddd, mmmm dS, yyyy, h:MM:ss TT");


			if(username == 'You'){
				html += '<div class="col-md-9 col-md-offset-2">';
				html += '    <div class="bubble bubble bubble-right">';
			}
			else{
				html += '<div class="col-md-9 col-md-offset-1">';
				html += '    <div class="bubble bubble-left">';
			}
			
			html += '        <div class="message">';
			html += '            <div class="user">';
			html += '                <p class="username"><b>'+username+'</b> wrote:</p>';
			html += '            </div>';
			html += '            <p>'+v.ticketing_comment_text.replace(/&nbsp;/g, ' ')+'</p>';
			html += '        </div>';
			html += '        <div class="files">';

			if(v.filename != null){
			  html += '			<ul class="media-ul"><li><a href="'+base_url+'uploads/ticket/'+v.filename+'" target="_blank"><i class="fa fa-file"></i> '+v.filename+'</a></li></ul>';
			}

			html += '		 </div>';
			html += '        <p class="time">'+datetime+'</p>';
			html += '    </div>';
			html += '</div>';

			if(animate == false){
				$('#viewTicketModal .discussion-cont').append(html);
			}
			else if(animate == true){
				$(html).hide().appendTo('#viewTicketModal .discussion-cont').show('slow');
			}

		});

		if(animate == false){
			setTimeout(function(){
			  $("#viewTicketModal .discussion-cont").animate({ scrollTop: $(".discussion-cont").prop("scrollHeight")}, 200);	
			}, 200);
		}
		else if(animate == true){
			setTimeout(function(){
			  $("#viewTicketModal .discussion-cont").animate({ scrollTop: $(".discussion-cont").prop("scrollHeight")}, 200);	
			}, 300);
		}

	}

	$('body').on('click','.ticketShowBtn',function(e){
		var ticket_id = $(this).data('ticket-id');

		$.ajax({
			type: 'post',
			url : base_url+'dashboard/get_tickets',
			data: {id:ticket_id,ticketing_media:true,ticketing_comment:true,department_users:true},
			success:function(response){
				setViewTicketModal(response);
			},
			dataType:'JSON'
		});

		$('#viewTicketModal').modal('show',function(){
			alert('test');
		});
	
	});

	function scrollTopElement(elem) {
	  var height = elem[0].scrollHeight;
	  elem.scrollTop(height);
	};	

	var addCommentEditor = new Jodit('#viewTicketModal .commentText');

	function setViewTicketModal(response){
		$('.dropzone-cust-cont').html('<div class="dropzone-cust" data-dz-url="'+base_url+'dashboard/file_upload" data-dz-file-name="filename2">');
		var ticketing_data = response.ticketing_data;
		var ticketing_media = response.ticketing_media;
		var ticketing_comment = response.ticketing_comment;
		var department_users = response.department_users;


		$('#viewTicketModal').attr('data-ticketing-id', ticketing_data.ticketing_id);

		$('#viewTicketModal .ticketing_min_resolve_time').countdown('destroy');
		$('#viewTicketModal .ticketing_max_resolve_time').countdown('destroy');

		ticketing_min_resolve_time = new Date(ticketing_data.ticketing_min_resolve_time); 
		$('#viewTicketModal .ticketing_min_resolve_time').countdown({until: ticketing_min_resolve_time, compact: true, description:''});

		ticketing_max_resolve_time = new Date(ticketing_data.ticketing_max_resolve_time); 
		$('#viewTicketModal .ticketing_max_resolve_time').countdown({until: ticketing_max_resolve_time, compact: true, description:''});


		var port_reference = (ticketing_data.campus_port_reference != null)?ticketing_data.campus_port_reference : ticketing_data.school_port_reference;

		$('#viewTicketModal .ticketing_id').text('Ticket #'+ticketing_data.ticketing_id+': ');
		$('#viewTicketModal .ticketing_titile').text(ticketing_data.ticketing_titile);
		$('#viewTicketModal .ticketing_current_status').html('<span class="'+ticketing_data.ticketing_current_status+'">('+ticketing_data.ticketing_current_status.replace('_',' ')+')</span>');
		$('#viewTicketModal .priority').html('<span class="label priority_'+ticketing_data.priority+'">'+ticketing_data.priority+'</span>');


		$('#viewTicketModal .ticketing_query_type').text(ticketing_data.ticketing_query_type);
		$('#viewTicketModal .query_generated_by').text(ticketing_data.query_generated_by);
		$('#viewTicketModal .school_name').text(ticketing_data.school_name);
		$('#viewTicketModal .campus_name').text(ticketing_data.campus_name);
		$('#viewTicketModal .port_reference').text(port_reference);
		$('#viewTicketModal .product_name').text(ticketing_data.product_name);
		$('#viewTicketModal .module_name').text(ticketing_data.module_name);
		$('#viewTicketModal .generated_by_user_name').text(ticketing_data.generated_by_user_name);
		$('#viewTicketModal .generated_by_department_name').text(ticketing_data.generated_by_department_name);
		$('#viewTicketModal .assigned_to_department_name').text(ticketing_data.assigned_to_department_name);
		$('#viewTicketModal .preferred_user_name').text(ticketing_data.preferred_user_name);
		$('#viewTicketModal .user_school_name').text(ticketing_data.user_school_name);

		//Assigning User Area
		if(user_type == 'admin' && user_department_id == ticketing_data.assigned_to_department_id){
			var users_html = '<select id="assigned_to_user_id">';
			users_html += '<option value="">No one</option>';
			$.each(department_users,function(k,v){

				if(v.user_type != 'superadmin'){
					var selected = '';
					if(v.user_id == ticketing_data.assigned_to_user_id){
						selected = 'selected="selected"';
					}

					users_html += '<option '+selected+' value="'+v.user_id+'">'+v.user_firstname+' '+v.user_lastname+'</option>';
				}
			});			
			users_html +='</select>';
			users_html +=' <button style="display:none;" class="btn btn-info btn-xs assigned_to_user_id_save"><i class="fa fa-save"></i></button>';
			$('#viewTicketModal .assigned_to_user_name').html(users_html);
		}
		else{
			$('#viewTicketModal .assigned_to_user_name').html(ticketing_data.assigned_to_user_name);
		}



		//Assigning Current Status Area
		$('#viewTicketModal .modal-header .ticketing_current_statuses').html('');
		var current_statuses_html = '';
		current_statuses_html += '<span>Current Status: </span><select id="ticketing_current_status">';

		var current_statuses_dev = {
			pending : 'Pending', 
			in_proccess: 'In Proccess',
			review_pending: 'Completed',
		};

		var current_statuses_cs = {
			pending : 'Pending', 
			in_proccess: 'In proccess',			
			review_pending: 'Review pending',
			client_pending: 'Client pending',
			completed: 'Completed',
			client_approved: 'Client approved'
		}

		
		//var current_statuses_user = ['in_proccess','review_pending'];
		
		var selected = '';
		var selected_count = 0;
		
		if(user_department_id == '2'){
			if(ticketing_data.assigned_to_user_id == user_id){
				$.each(current_statuses_cs,function(k,v){
					selected = '';
					if(k == ticketing_data.ticketing_current_status){
						selected = 'selected="selected"';
						selected_count++;
					}
					current_statuses_html += '<option '+selected+' value="'+k+'">'+v.replace('_',' ')+'</option>';
				});		
			}
		}	

		else if(user_department_id == '1' || user_department_id == '3'){
			$.each(current_statuses_dev,function(k , v){
				selected = '';
				if(k == ticketing_data.ticketing_current_status){
					selected = 'selected="selected"';
				}
				current_statuses_html += '<option '+selected+' value="'+k+'">'+v.replace('_',' ')+'</option>';
			});		
		}	
		
		current_statuses_html +='</select>';
		current_statuses_html +=' <button style="display:none;" class="btn btn-info btn-xs ticketing_current_status_save"><i class="fa fa-save"></i></button>';
		
		if(user_type == 'user'){
			console.log(selected);
			if(selected_count > 0){
				$('#viewTicketModal .modal-header .ticketing_current_statuses').html(current_statuses_html);
			}
		}
		else{			
			$('#viewTicketModal .modal-header .ticketing_current_statuses').html(current_statuses_html);
		}


		$('#viewTicketModal .ticketing_query').html(ticketing_data.ticketing_query.replace(/&nbsp;/g, ' '));
		$('#viewTicketModal .commentText').val('');
		addCommentEditor.value = '';


		// MEDIA
		$('#viewTicketModal .media-ul').html('');
		if(ticketing_media != ''){
			$.each(ticketing_media,function(k,v){

				$('#viewTicketModal .media-ul').append('<li><a href="'+base_url+'/uploads/ticket/'+v.filename+'" target="_blank"><i class="fa fa-file"></i> '+v.filename+'</a></li>');
			});
		}
		else{
			$('#viewTicketModal .media-ul').html('<i></i> No media found');

		}


		//COMMENTS 		
		$('#viewTicketModal .discussion-cont').html('');
		appendComments(ticketing_comment);

		if(ticketing_data != ''){
			dzInit();
			$('#viewTicketModal').modal('show');
		}
	}

	$('#viewTicketModal').on('hide.bs.modal', function () {
	    $(this).attr('data-ticketing-id','');
	})


	
	$('body').on('change','#assigned_to_user_id',function(){	
		$('body').find('.assigned_to_user_id_save').fadeIn();
	});
	

	$('body').on('change','.ticketing_current_statuses #ticketing_current_status',function(){	
		$('body').find('.ticketing_current_status_save').fadeIn();
	});
	

	$('body').on('click','#viewTicketModal .assigned_to_user_id_save',function(){	
		var _this  = $(this);
		var assigned_to_user_id = $('body').find('#assigned_to_user_id').val();	
		var ticketing_id = $(this).parents('#viewTicketModal').attr('data-ticketing-id');
		$.ajax({
			url:base_url+'dashboard/ticket_assigned_to_user',
			data:{assigned_to_user_id :assigned_to_user_id,ticketing_id:ticketing_id},
			type:'post',
			success:function(response){
				if(response == 'true'){
					_this.fadeOut();
				}
			}
		});				
	});

	$('body').on('click','#viewTicketModal .ticketing_current_status_save',function(){	
		var _this  = $(this);
		var ticketing_current_status = $('body').find('#ticketing_current_status').val();	
		var ticketing_id = $(this).parents('#viewTicketModal').attr('data-ticketing-id');
		$.ajax({
			url:base_url+'dashboard/ticket_status_change',
			data:{ticketing_current_status :ticketing_current_status,ticketing_id:ticketing_id},
			type:'post',
			success:function(response){
				if(response == 'true'){
					_this.fadeOut();
				}
			}
		});				
	});
 



	$('#viewTicketModal .addComment').click('click',function(e){
		e.preventDefault();
		var ticketing_comment_text = $('#viewTicketModal .commentText').val();
		var ticketing_id = $('#viewTicketModal').attr('data-ticketing-id');

		var data = {
				ticketing_id:ticketing_id,
				ticketing_comment_text:ticketing_comment_text
			};
		
		if ($('#commentForm').find('input[name=filename2]').val() !==  '') {
			data['filename2'] = $('#commentForm').find('input[name=filename2]').val();
		}


		//console.log(data);


		$.ajax({
			url : base_url+'dashboard/submit_ticketing_comment',
			type : 'post',
			data : data,
			success : function(response){
				$('#viewTicketModal .commentText').val('');
				$('.dropzone-cust-cont').html('<div class="dropzone-cust" data-dz-url="'+base_url+'dashboard/file_upload" data-dz-file-name="filename2">');
				addCommentEditor.value = '';
				dzInit();
				appendComments(response,true);
			},
			dataType: 'JSON'
		});
	});



	$('.closeBtn').on('click',function(){
		var taskId = $(this).parents('#viewTicketModal').attr('data-ticketing-id');
		taskBarRemoveItem(taskId);
	});


	$('.minimizeBtn').on('click',function(){
		var taskId = $(this).parents('#viewTicketModal').attr('data-ticketing-id');
		taskBarAddItem(taskId);
	});

	 function taskBarAddItem(id = ""){
	 	taskIds = window.sessionStorage.minimzedItems.split(','); 	
	 	taskIds.indexOf(id) === -1 ? taskIds.push(id) : console.log("This item already exists");
	 	window.sessionStorage.minimzedItems = taskIds;
	 	loadTaskBar();
	 }

	 function taskBarRemoveItem(id = ""){
	 	taskIds = window.sessionStorage.minimzedItems.split(',');
	 	index = taskIds.indexOf(id);
	 	if (index !== -1) taskIds.splice(index, 1);
	 	window.sessionStorage.minimzedItems = taskIds;
	 	loadTaskBar();
	 }	 

	 loadTaskBar();

	 function loadTaskBar(){
	 	$('.taskbar ul').html('');
	 	taskIds = window.sessionStorage.minimzedItems.split(',');
	 	$.each(taskIds,function(k,v){
	 		if(v != ''){
	 			$('.taskbar ul').append('<li data-ticket-id="'+v+'" class="ticketShowBtn">Ticket #'+v+'</li>');
	 		}
	 	});

	 	if($('.taskbar ul').find('li').length > 0){
			$('.taskbar').fadeIn();
	 	}
	 	else{	 		
	 		$('.taskbar').fadeOut();
	 	}
	 }


	 if(uri_segment1 ==''){ 
	 	$('body').removeClass('nav-md');
	 	$('body').addClass('nav-sm'); 
	}

	hotkeys('ctrl+q', function(event, handler){
	  event.preventDefault() 
	  $('#newTicketModal').modal('toggle');
	});

	hotkeys('ctrl+a', function(event, handler){
	  event.preventDefault() 
	});	

	hotkeys('ctrl+m', function(event, handler){
	  event.preventDefault() 
	  $('body').toggleClass('nav-sm');
	  $('body').toggleClass('nav-md');
	});		

	hotkeys('ctrl+s', function(event, handler){
	  event.preventDefault();
	  if($('#searchTicket').is(":focus")){
	  	event.preventDefault();
	  }else{
	  	$('#searchTicket').focus();
	  }
	});		

	var notificationoffset = 10;
	$('#menu1').bind('scroll', function(){
		var elem = $(this);
	    if (elem[0].scrollHeight - elem.scrollTop() < elem.outerHeight()) {
	        appendNotification(notificationoffset);
	        notificationoffset = notificationoffset+ 10;


	    }
	});

	$('#menu1').on('click','.ticketShowBtn',function(e){
		$(this).parent('li').addClass('read');
		$(this).parents('.dropdown').addClass('open');
		var id = $(this).attr('data-notification-id');
		$.ajax({
			url: base_url+'notifications/read',
			type:'post',
			data: {id:id},
			success:function(){
				countNotifications();
			}
		});
	});

	appendNotification(0);

	function countNotifications(){
		$.ajax({
			url: base_url+'notifications/count',
			dataType:'JSON',
			type:'get',
			success:function(response){
				if(response != ''){
					$('.notificationCount').hide(function(){
						if(response != 0){
							$(this).text(response).show('slow');
						}
					});
				}				
			}
		});		
	}

	countNotifications();

	function appendNotification(offset = 0){
		$.ajax({
			url: base_url+'notifications/get/'+offset+'/json',
			dataType:'JSON',
			type:'get',
			success:function(response){
				$.each(response,function(k,v){
					var html = '';
					html +='        <li class="'+v.notification_read_status+'">';
		            html +='           <a class="ticketShowBtn" data-notification-id="'+v.notification_id+'" data-ticket-id="'+v.ticketing_id+'" href="#">';
		            html +='             <span class="message"><b><i class="fa fa-ticket"></i> 	';
		            html +=				  v.notification_text;
		            html +='             </b></span>';		            
		            html +='             <span class="message">';
		            html +=				  '<b>Ticket #</b> '+v.ticketing_id+ ' '+v.ticketing_titile;
		            html +='             </span>';
		            html +='             <span class="time">'+dateFormat(v.notification_activity_at, "dddd, mmmm dS, yyyy, h:MM:ss TT")+'</span>';
		            html +='             </span>';		            
		            html +='           </a>';
		            html +='         </li>';

		        	$(html).hide().appendTo('#menu1').slideDown('slow');
				});
			}
		});
	}


	$('.check_all').on('click',function(e){
		e.preventDefault();
		var checkBoxes = $(this).parents('tr').children('td').children('input[type=checkbox]');
		checkBoxes.prop("checked", !checkBoxes.prop("checked"));

		$(this).toggleText('Check All', 'Uncheck All');
	});



	jQuery.fn.extend({
	    toggleText: function (a, b){
	        var that = this;
	            if (that.text() != a && that.text() != b){
	                that.text(a);
	            }
	            else
	            if (that.text() == a){
	                that.text(b);
	            }
	            else
	            if (that.text() == b){
	                that.text(a);
	            }
	        return this;
	    }
	});



	setTimeout(function(){
		$('.alert-dismissible').fadeOut();
	},10000);
});


