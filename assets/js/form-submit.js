(function($) {

	var formSubmit = {
		startDate: "",
		endData: "",
		init : function(){
			$("#server-error").hide();
			this.submit();
			this.filter();
		},
		submit: function(){
			$("#register-form").on('submit', function(e){
				e.preventDefault();
				let error = $("#server-error");
				let setForm = $('#register-form');
				$(".form-submit").html('<div class="submit-nutton-loader-wraper"><div class="submit-nutton-loader"></div></div>')
				$.ajax({
					type:'POST',
					url: '../classes/class-save-fom.php',
					data: $(this).serialize()
				}).then(function(res){
					let data = JSON.parse(res);
					$(".form-submit").html('<input type="submit" value="Submit" class="submit" id="submit" name="submit">');
					if(data.error){
						error.show();
						error.addClass('error');
						error.html('<p>'+data.error+'</p>');
						return;
					}

					Swal.fire({
					  icon: 'success',
					  title: 'Success',
					  text: data.success,
					}).then( function(){
						location.reload();
					});

				});
			});
		},
		filter: function(){
			let dateFilter = this;
			$("#star_date").on('change', function(){
				dateFilter.startDate = $(this).val();
				dateFilter.fliterResult();
			});

			$("#end_date").on('change', function(){
				dateFilter.endData = $(this).val();
				dateFilter.fliterResult();
			});
		},
		fliterResult: function(){
			if(this.startDate && this.endData){
				$('#table-list').html('<div class="filter-loader"></div>');
				$.ajax({
					type:'POST',
					url: '../classes/class-data-filter.php',
					data: {startdate:this.startDate, enddate:this.endData}
				}).then(function(res){
					$("#table-list").html(res);
				});
			}
		}
	}

	formSubmit.init();

})(jQuery);