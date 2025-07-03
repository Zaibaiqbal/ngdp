<script type="text/javascript">

	function getSubTheme(key_pair)
	{
		// showLoader();

		// var theme     = $('.theme_'+key_pair);

		// var sub_theme = $('.sub_theme_'+key_pair);

		// $.get("{{url('themesubtheme')}}/"+theme.val(),function(data)
		// {
		// 	sub_theme.html(data);

		// 	removeLoader();

		// });
	}

	function resetKnowladgeHub()
	{
		showLoader();

		var route  =  "{{route('resetknowladge')}}"

		var token  =  "{{Session::token()}}";

		var data_set = {_token:token}

		 $.post(route,data_set,function(data, status){

		      if(data == "1")
		      {
		      	    Lobibox.notify('info', {
		                msg: 'Record not found.'
		            });
		      }
		      else
		      {
			      // Lobibox.notify('info', {
		       //        msg: 'Reset succssfully .'
		       //    });
		      	 $('.show-results').html(data);
		      }

			removeLoader();

		  })
        .fail(function(data) {
			       Lobibox.notify('info', {
		                msg: 'Record not found.'
		            });
			       removeLoader();

		  });;
	}

	function showMultipleThemeData(event,obj)
	{
		event.preventDefault();

		if($(obj).hasClass('cls-active'))
		{
			$(obj).removeClass('cls-active');
			$(obj).remove("active");
			// $(obj).css("background-color", "black");
		}
		else
		{
			$(obj).addClass('cls-active');
		}
		var active_theme_list = [];
		var count = 0;
		var headerArray = [];

		$('#accordion .in').each(function(){
		headerArray.push(this.id); 
		});

		$('.theme_list_active').each(function(event){

			if($(this).hasClass('cls-active'))
			{
				active_theme_list[count] = $(this).attr('value');
			    count++;
			}
		
		});

		$('.all_data').removeClass('cls-active');
		showMultipleThemeData2(active_theme_list,headerArray);


	}
	function showMultipleThemeData2(active_theme_list,headerArray){


		var route = "{{url('showmultiplethemedata')}}";
		
		showLoader();

		var theme_ids = [];

		var count = 0;

		// $(active_theme_list).each(function(event){

		// theme_ids[count] = $(this).attr('value'); 
		// 	count++;
		// });

		var token  =  "{{Session::token()}}";

		var formdata = {'theme_ids':active_theme_list,_token:token};

		$.post(route, formdata, function(result)
		{
			if(result)
					{	
						// Lobibox.notify('info', {
						//      msg: 'Record not found.'
						//  });

					$('.show-results').html(result.view);
					$.each(headerArray, function (index, item) {
		
					$("#"+item).collapse('show');

					});

					}
					removeLoader();
		
		
		},'json')
		.fail(function(result) {
			Lobibox.notify('info', {
										msg: 'Record not found.'
								});
			removeLoader();

		});

	}

	function searchKnowladgeHub2(myid)
	{
		showLoader();

		var route  =  "{{route('searchknowladge')}}"

		var token  =  "{{Session::token()}}";

		var keyword = "";

		$("#searchindi").val("");

		var theme = myid;

		var data_set = {search_value:theme,_token:token,keyword:keyword}

		 $.post(route,data_set,function(data, status){

					if(data.status == "1")
					{
								// Lobibox.notify('info', {
							 //      msg: 'Record not found.'
							 //  });


							$('.show-results').html(data.view);

					}
					else if(data.status == "2")
					{
						// Lobibox.notify('success', {
					 //        msg: 'Record Found.'
					 //    });

						 $('.show-results').html(data.view);
					}

			removeLoader();

			})
				.fail(function(data) {
						 Lobibox.notify('info', {
										msg: 'Record not found.'
								});
						 removeLoader();

			});;

	}

	function searchKnowladgeHub()
	{
		showLoader();

		var route  =  "{{route('searchknowladge')}}"

		var token  =  "{{Session::token()}}";

		var keyword = $("#searchindi").val();

		var theme = $("#themelist").val();
		var data_set = {search_value:theme,_token:token,keyword:keyword}

		 $.post(route,data_set,function(data, status){

		      if(data.status == "1")
		      {
		      	    // Lobibox.notify('info', {
		           //      msg: 'Record not found.'
		           //  });


		      	  $('.show-results').html(data.view);

		      }
		      else if(data.status == "2")
		      {
			      // Lobibox.notify('success', {
		       //        msg: 'Record Found.'
		       //    });

		      	 $('.show-results').html(data.view);
		      }

			removeLoader();

		  })
        .fail(function(data) {
			       Lobibox.notify('info', {
		                msg: 'Record not found.'
		            });
			       removeLoader();

		  });;

	}


	function storeReport(event,obj)
	{
	    document.getElementById('ulshow').style.display = 'none';

		event.preventDefault();

		var obj = $('#form_add_report');

		var form = document.querySelector('#form_add_report') // Find the <form> element
		var formData = new FormData(form); // Wrap form contents

		var route = obj.attr('action');


		// alert(ajax_validate(obj,'add customer'));

		showLoader();

		$.ajax({
		url: route,
		type: obj.attr('method'),
		data:  formData,
		dataType: "json",
		contentType: false,
		cache: false,
		processData:false,
		success: function(result){
			if(result == 1)
		    {
				location.reload();
		    }
		    else
		    {


		    }
	    	removeLoader();
		},
		error: function(data)
			   {
			       ajax_show_error(data);
			   }
		});
	}

	function updateReport(event,obj)
	{

		event.preventDefault();

		var obj = $('#form_update_report');

		var form = document.querySelector('#form_update_report') // Find the <form> element
		var formData = new FormData(form); // Wrap form contents

		var route = obj.attr('action');


		// alert(ajax_validate(obj,'add customer'));

		showLoader();

		$.ajax({
		url: route,
		type: obj.attr('method'),
		data:  formData,
		dataType: "json",
		contentType: false,
		cache: false,
		processData:false,
		success: function(result){
			if(result == 1)
		    {
				location.reload();
		    }
		    else
		    {


		    }
	    	removeLoader();
		},
		error: function(data)
			   {
			       ajax_show_error(data);
			   }
		});
	}

	 // AJAX REQUEST TO STORE USER(EMPLOYEE) WHILE COMMISSION
	function storeArticle(event,obj)
	{
		event.preventDefault();
		var obj = $('#form_add_article');
		var form = document.querySelector('#form_add_article') // Find the <form> element
		var formData = new FormData(form);
		var route = obj.attr('action');

        showLoader();

				$.ajax({
				url: route,
				type: obj.attr('method'),
				data:  formData,
				dataType: "json",
				contentType: false,
				cache: false,
				processData:false,
				success: function(result){
			if(result == 1)
				{

		    	location.reload();

		    }
        removeLoader();


			},
			error: function(data)
				   {
				       ajax_show_error(data);
				   }
			});
	}


	function updateArticle(event,obj)
	{
		event.preventDefault();
		var obj = $('#form_update_article');
		var form = document.querySelector('#form_update_article') // Find the <form> element
		var formData = new FormData(form); // Wrap form contents

		var route = obj.attr('action');


		// alert(ajax_validate(obj,'add customer'));

		showLoader();

		$.ajax({
		url: route,
		type: obj.attr('method'),
		data:  formData,
		dataType: "json",
		contentType: false,
		cache: false,
		processData:false,
		success: function(result){
			if(result == 1)
				{

		    	location.reload();

		    }
        removeLoader();


        },
				error: function(data)
					   {
					       ajax_show_error(data);
					   }
				});
	}

	function storeDataset(event,obj)
	{
		event.preventDefault();
		var obj = $('#form_add_data_set');
		var form = document.querySelector('#form_add_data_set') // Find the <form> element
		var formData = new FormData(form);
		var route = obj.attr('action');

				showLoader();

				$.ajax({
				url: route,
				type: obj.attr('method'),
				data:  formData,
				dataType: "json",
				contentType: false,
				cache: false,
				processData:false,
				success: function(result){
			if(result == 1)
				{

		    	location.reload();

		    }
        removeLoader();


        },
				error: function(data)
					   {
					       ajax_show_error(data);
					   }
				});
	}

	function updateDataset(event,obj)
	{
		event.preventDefault();
		var obj = $('#form_update_data_set');
		var form = document.querySelector('#form_update_data_set') // Find the <form> element
		var formData = new FormData(form); // Wrap form contents

		var route = obj.attr('action');


		// alert(ajax_validate(obj,'add customer'));

		showLoader();

		$.ajax({
		url: route,
		type: obj.attr('method'),
		data:  formData,
		dataType: "json",
		contentType: false,
		cache: false,
		processData:false,
		success: function(result){
			if(result == 1)
				{

		    	location.reload();

		    }
        removeLoader();


        },
				error: function(data)
					   {
					       ajax_show_error(data);
					   }
				});
	}

	function storeInfographics(event,obj)
	{

		event.preventDefault();

		var obj = $('#form_add_infographics');

		var form = document.querySelector('#form_add_infographics') // Find the <form> element
		var formData = new FormData(form); // Wrap form contents

		var route = obj.attr('action');


		// alert(ajax_validate(obj,'add customer'));

		showLoader();

		$.ajax({
		url: route,
		type: obj.attr('method'),
		data:  formData,
		dataType: "json",
		contentType: false,
		cache: false,
		processData:false,
		success: function(result){
			if(result == 1)
		    {
				location.reload();
		    }
		    else
		    {


		    }
	    	removeLoader();
		},
		error: function(data)
			   {
			       ajax_show_error(data);
			   }
		});
	}

	function updateInfographics(event,obj)
	{

		event.preventDefault();

		var obj = $('#form_update_infographic');

		var form = document.querySelector('#form_update_infographic') // Find the <form> element
		var formData = new FormData(form); // Wrap form contents

		var route = obj.attr('action');


		// alert(ajax_validate(obj,'add customer'));

		showLoader();

		$.ajax({
		url: route,
		type: obj.attr('method'),
		data:  formData,
		dataType: "json",
		contentType: false,
		cache: false,
		processData:false,
		success: function(result){
			if(result == 1)
		    {
				location.reload();
		    }
		    else
		    {


		    }
	    	removeLoader();
		},
		error: function(data)
			   {
			       ajax_show_error(data);
			   }
		});
	}

	 // AJAX REQUEST TO STORE USER(EMPLOYEE) WHILE COMMISSION
	function storeOtherKnowledge(event,obj)
	{
		event.preventDefault();
		var obj = $('#form_add_other');
		var form = document.querySelector('#form_add_other') // Find the <form> element
		var formData = new FormData(form);
		var route = obj.attr('action');

				showLoader();

				$.ajax({
				url: route,
				type: obj.attr('method'),
				data:  formData,
				dataType: "json",
				contentType: false,
				cache: false,
				processData:false,
				success: function(result){
			if(result == 1)
				{

		    	location.reload();

		    }
        removeLoader();


        },
				error: function(data)
					   {
					       ajax_show_error(data);
					   }
				});
	}

	function updateOtherKnowledge(event,obj)
	{
		event.preventDefault();
		var obj = $('#form_update_other');
		var form = document.querySelector('#form_update_other') // Find the <form> element
		var formData = new FormData(form); // Wrap form contents

		var route = obj.attr('action');


		// alert(ajax_validate(obj,'add customer'));

		showLoader();

		$.ajax({
		url: route,
		type: obj.attr('method'),
		data:  formData,
		dataType: "json",
		contentType: false,
		cache: false,
		processData:false,
		success: function(result){
			if(result == 1)
				{

		    	location.reload();

		    }
        removeLoader();


        },
				error: function(data)
					   {
					       ajax_show_error(data);
					   }
				});
	}

	function storeLawRegulation(event,obj)
	{
		event.preventDefault();
		var obj = $('#form_add_law_regulation');
		var form = document.querySelector('#form_add_law_regulation') // Find the <form> element
		var formData = new FormData(form);
		var route = obj.attr('action');

        showLoader();

				$.ajax({
				url: route,
				type: obj.attr('method'),
				data:  formData,
				dataType: "json",
				contentType: false,
				cache: false,
				processData:false,
				success: function(result){
			if(result == 1)
		    {

		    	location.reload();

		    }
        removeLoader();


        },
				error: function(data)
					   {
					       ajax_show_error(data);
					   }
				});
	}

	function updateLawRegulation(event,obj)
	{
		event.preventDefault();
		var obj = $('#form_update_law_regulation');
		var form = document.querySelector('#form_update_law_regulation') // Find the <form> element
		var formData = new FormData(form); // Wrap form contents

		var route = obj.attr('action');


		// alert(ajax_validate(obj,'add customer'));

		showLoader();

		$.ajax({
		url: route,
		type: obj.attr('method'),
		data:  formData,
		dataType: "json",
		contentType: false,
		cache: false,
		processData:false,
		success: function(result){
			if(result == 1)
				{

		    	location.reload();

		    }
        removeLoader();


        },
				error: function(data)
					   {
					       ajax_show_error(data);
					   }
				});
	}

	function searchTheme()
	{
	  var value = $("#searchindi").val();

	  if(value == null || value == '')
	  {
	    $('#ulshow').html('');
	    document.getElementById('ulshow').style.display = 'none';
	  }
	  else{

	  $.ajax({
	      type : 'post',
	      url : "{{ route('searchknowledgetheme')}}",
	      data:{"search":value,"_token": "{{ csrf_token() }}"},
	      success:function(data){
	      document.getElementById('ulshow').style.display = 'block';
	      $('#ulshow').html(data);
	      }
	      });
	    }
	}

	$('#searchindi').mouseup(function(e){

	    document.getElementById('ulshow').style.display = 'none';



});
</script>
