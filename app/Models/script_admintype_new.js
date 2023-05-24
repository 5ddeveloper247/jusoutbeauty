var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$compile,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

//	$(document).on('click','.addNew',function(){
//	    $('#addCity_modal').modal('show');return false; 
//	});

//	$(document).on('click','.modalClose',function(){
//	    $('#addCity_modal').modal('hide');return false; 
//	});
	
	$scope.routinename={};
	$scope.routinename.ID = "";
	$scope.routinename.P_1 = "";
	$scope.routinename.P_2 = "";
	$scope.routinename.P_3 = "";
	$scope.routinename.P_4 = "";
	
    $scope.routinetypedata={};
	$scope.routinetype={};
	$scope.routinetype.ID="";
	$scope.routinetype.R_1="";


	$scope.routinetypelov={};
	$scope.routinetypelov.ID="";

	$scope.categorylov={};
	$scope.category={};
	$scope.category.ID="";
	$scope.subcategorylov={};
	$scope.subcategory={};
	$scope.subcategory.ID="";
	$scope.subsubcategorylov={};
	$scope.subsubcategory={};
	$scope.subsubcategory.ID="";


	$scope.productlov={};
	$scope.product={};
	$scope.product.P_7="";
	$scope.product.P_8="";
	$scope.product.P_9="";
	$scope.product.P_10="";
	$scope.product.P_11="";
	$scope.product.P_12="";
	$scope.product.P_13="";

	$scope.product.ID="";

	
/* Get all Routine Types */
/* --------------------------------------------------- */
$scope.getroutinetypes = function(){
		
		$http({
			data: $scope.tokenHash,
			url : site+"/showAllRoutineTypes",
			method: "GET",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			if ($.fn.DataTable.isDataTable("#type_table")) {
				$('#type_table').DataTable().clear().destroy();
			}
			$scope.getAllRoutineTypes = data.getAllRoutineType;
			console.log($scope.getAllRoutineTypes);
			
			setTimeout(function(){
				$('#type_table').DataTable( {
				   order: [],
				   aLengthMenu: [
								 [10, 25, 50, 100, 200, -1],
								 [10, 25, 50, 100, 200, "All"]
							 ]
			   } );
		   }, 500);
		})
		.error(function(data, status, headers, config) {
			console.log(error);
		});
	}

	$scope.getroutinetypes();
/* --------------------------------------------------- */


	$scope.Steps={};
	// $scope.steps={};
	// $scope.steps.S_1="";


//	$scope.routinenameId = ingredientId;

	$scope.editView = 0;

	$scope.tokenHash = $("#csrf").val();

	$scope.getAllAdminProductlov = function(){
		
		var data = {};
	    data.userId = userId;
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllAdminProductlov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			$scope.categoryLov = data.list1;
			$scope.subCategoryLov = {};
		
			setTimeout(function(){
				 $('#productsTable').DataTable( {
					order: [],
		            aLengthMenu: [
		                          [10, 25, 50, 100, 200, -1],
		                          [10, 25, 50, 100, 200, "All"]
		                      ]
		        } );
			}, 500);
			
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.getAllAdminProductlov();


	$scope.getSubCategoriesWrtCategory = function(){
		
		if($scope.product.P_8 != null){
			var data = {};
		    data.category = $scope.product.P_8;
		    data.userId = userId;
		    
	    	var temp = $.param({details: data});

	    	
			$http({
				data: temp+"&"+$scope.tokenHash,
				url : site+"/getSubCategoriesWrtCategory",
				method: "POST",
				async: false,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}

			}).success(function(data, status, headers, config) {
					
				$scope.subcategorylov = data.subCategory;
				$scope.productlov=data.product;

				setTimeout(function(){
				

				}, 500);
				// $('#p46').val($scope.handpickedlo['id']).trigger('change');
				// $('#p47').val($scope.recommended['id']).trigger('change');
				
			})
			.error(function(data, status, headers, config) {
			});
		}else{
			$scope.subCategoryLov = {};
		}
	}

	$scope.getproductswrtsubcategory = function(){
		
		if($scope.product.P_10 != null){
			var data = {};
		    data.subcategory = $scope.product.P_10;
		    data.userId = userId;
		    
	    	var temp = $.param({details: data});
	    	
			$http({
				data: temp+"&"+$scope.tokenHash,
				url : site+"/getproductswrtsubcategory",
				method: "POST",
				async: false,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}

			}).success(function(data, status, headers, config) {
					
				$scope.productlov=data.product;

			})
			.error(function(data, status, headers, config) {
			});
		}else{
		}
	}


	// $scope.getsteps = function(){
		
	// 		var data = {};
	// 		data.id = $scope.routinename.ID;
	// 	    data.userId = userId;
		    
	//     	var temp = $.param({details: data});
	    	
	// 		$http({
	// 			data: temp+"&"+$scope.tokenHash,
	// 			url : site+"/getsteps",
	// 			method: "POST",
	// 			async: false,
	// 			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

	// 		}).success(function(data, status, headers, config) {
					
	// 			$scope.productlov=data.product;

	// 		})
	// 		.error(function(data, status, headers, config) {
	// 		});
	// }


	$scope.getSubSubCategoriesWrtCategory = function(){
		
		if($scope.product.P_9 != null){
			var data = {};
		    data.subcategory = $scope.product.P_9;
		    data.userId = userId;
		    
	    	var temp = $.param({details: data});
	    	
			 $http({
				data: temp+"&"+$scope.tokenHash,
				url : site+"/getSubSubCategoriesWrtSubCategory",
				method: "POST",
				async: false,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}

			 }).success(function(data, status, headers, config) {
					
				$scope.subsubcategorylov = data.subSubCategory;
				$scope.productlov=data.product;
			 })
			.error(function(data, status, headers, config) {
			});
		}else{
			$scope.subsubcategorylov = {};
		}
	}

	$scope.getAllAdminRoutinenamelov = function(){
		
		var data = {};
	    data.userId = userId;
	    data.ingredientId = $scope.routinenameId;
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllAdminroutinetype',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if ($.fn.DataTable.isDataTable("#ingredientTable")) {
				$('#ingredientTable').DataTable().clear().destroy();
			}
			
			$scope.displayCollection = data.list;
		
			setTimeout(function(){
				$("#ingredientTable").DataTable({
					order: [],
		            aLengthMenu: [
		                          [10, 25, 50, 100, 200, -1],
		                          [10, 25, 50, 100, 200, "All"]
		                      ]
				});
			}, 500);
			
//			if($scope.routinenameId != '' && data.details != ''){
//				$scope.editFlag = 1;
//				$scope.continouRecord(data.details);
//			}
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.getAllAdminRoutinenamelov();
		
	
	$scope.reset = function(){
		$scope.routinename={};
		$scope.routinename.ID = "";
		$scope.routinename.P_1 = "";
		$scope.routinename.P_2 = "";
		$scope.routinename.P_3 = "";
		$scope.routinename.P_4 = "";
	
		$("#p_att").html('');
		
		setTimeout(function(){
			$("#quantity_in_stock").val($scope.routinename.P_2).trigger('change');
			$(".summernote").summernote("code", $scope.routinename.P_4);
		}, 500);
		
	}
	
	$scope.addNew = function(){
		$scope.routinename={};
		$scope.RoutineTypelov={};
		$scope.routinetypedata={};
		$scope.Steps={};
		$scope.routinetype.C_1= "" ;
		$scope.routinetype.ID=""
		$scope.routinename.ID = "";
		$scope.routinename.P_1 = "";
		$scope.routinename.P_2 = "";
		$scope.routinename.P_3 = "";
		$scope.routinename.P_4 = "";

		$('#summernote').summernote('code','');
		$("#p_att").html('');
		
		// setTimeout(function(){
		// 	$("#quantity_in_stock").val($scope.routinename.P_2).trigger('change');
		// 	$(".summernote").summernote("code", $scope.routinename.P_4);
		// }, 500);
		
		$scope.editView = 1;
		setTimeout(function(){
			if ($.fn.DataTable.isDataTable("#steps_table")) {
				$('#steps_table').DataTable().clear().destroy();
			}
			
			// setTimeout(function(){
			// 	$('#steps_table').DataTable( {
			// 		order: [],
			// 		aLengthMenu: [
			// 					  [10, 25, 50, 100, 200, -1],
			// 					  [10, 25, 50, 100, 200, "All"]
			// 				  ]
			// 	} );
			// }, 500);

			// if ($.fn.DataTable.isDataTable("#type_table")) {
			// 	$('#type_table').DataTable().clear().destroy();
			// }
			
			// setTimeout(function(){
			// 	$('#type_table').DataTable( {
			// 		order: [],
			// 		aLengthMenu: [
			// 					  [10, 25, 50, 100, 200, -1],
			// 					  [10, 25, 50, 100, 200, "All"]
			// 				  ]
			// 	} );
			// }, 500);
			

		   
	   }, 1000);
	}
	$scope.backToListing = function(){
		$scope.getAllAdminRoutinenamelov();
		$scope.editView = 0;
		setTimeout(function(){

			if ($.fn.DataTable.isDataTable("#steps_table")) {
				$('#steps_table').DataTable().clear().destroy();
			}

			if ($.fn.DataTable.isDataTable("#type_table")) {
				$('#type_table').DataTable().clear().destroy();
			}
			
	   }, 500);
		
	}
	$scope.saveRoutinename = function(){

		
		if ($('.summernote').summernote('isEmpty')) {
			$scope.routinename.P_4 = '';
		}else{
			$scope.routinename.P_4 = $('#summernote').summernote('code');
		}
		
	    	var data = {};
	        data.Routinename = $scope.routinename;
	        data.userId = userId;
    	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/routine_type_add",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.routinename.ID = data.ID;
//				window.location = data.redirect_url;
				
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.getTypeNameLov = function(){
		
		if($scope.product.P_8 != null){
			var data = {};
		    data.typeid = $scope.routinename.ID;
		    data.userId = userId;
		    
	    	var temp = $.param({details: data});

	    	
			$http({
				data: temp+"&"+$scope.tokenHash,
				url : site+"/getTypeNameLov",
				method: "POST",
				async: false,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}

			}).success(function(data, status, headers, config) {
					
				$scope.RoutineTypelov = data;

				setTimeout(function(){
				

				}, 500);
				// $('#p46').val($scope.handpickedlo['id']).trigger('change');
				// $('#p47').val($scope.recommended['id']).trigger('change');
			})
			.error(function(data, status, headers, config) {
			});
		 }else{
			$scope.subCategoryLov = {};
		 }
	 }
	
	 $scope.checksteps = function(){
		
		 var data = {};  
		 data.routinetypeid = $scope.product.P_7;
		 // data.typeid= $scope.routinename.ID;
		 data.userId = userId;
		 var temp = $.param({details: data});

     $http({
	   data: temp+"&"+$scope.tokenHash, 
	   url : site+"/checksteps",
	   method: "POST",
	   async: false,
	   headers: {'Content-Type': 'application/x-www-form-urlencoded'}

     }).success(function(data, status, headers, config) {
		   
	   if(data.done == true || data.done == 'true'){
		   // $scope.getTypeNameLov();

              if(data.count== 0){
				$scope.product.P_13 = 1 ;
				$('#step_no').text(' ');
				$('#step_no').text('Step # 1');

			  }else{
				$scope.product.P_13 = data.count;
				$('#step_no').text(' ');
				$('#step_no').text('Step # '+data.count);
			  }
				$('.step_show').show();

		   // $scope.routinename.ID = data.ID;
          //				window.location = data.redirect_url;
		   
	   }else{
		   toastr.error(data.msg, '', {timeOut: 3000})
	   }
   })
   .error(function(data, status, headers, config) {
   });
}
     
        $scope.addstepsmodal = function (){ 
             
			 $('.step_show').hide();
			 $scope.product.P_11="";
			 $scope.product.P_12="";
			 $scope.product.P_13="";
			 $scope.product.P_9="";
			 $scope.product.P_10="";

             $('#RoutineTypeStepsModal').modal('show');
		}

		$scope.removetypenamemodal =function(id){
		
			$('#routine_type_remove_id').val('');

			$('#routine_type_remove_id').val(id);

			$('#alertroutinetypemodal').modal('show');
		 }
          
		$scope.removestepmodal =function(id){


			 $('#step_remove_id').val('');
			 
			 $('#step_remove_id').val(id);

			 $('#alertsteps').modal('show');

     	 }

		  $scope.removeroutinemodal =function(id){


			$('#routine_remove_id').val('');
			
			$('#routine_remove_id').val(id);

			$('#alertroutinemodal').modal('show');

		 }

		         
		 $scope.remove_routine = function(){

			// $scope.alertDeleteMsg = 'Are You Sure You want to delete this step';

			// $("#alertDel").modal('show');
			var data = {};
		     
			data.routineid = $('#routine_remove_id').val();
		   //  data.typeid= $scope.routinename.ID;
			data.userId = userId;
			var temp = $.param({details: data});
	   $http({
		   data: temp+"&"+$scope.tokenHash, 
		   url : site+"/remove_routine",
		   method: "POST",
		   async: false,
		   headers: {'Content-Type': 'application/x-www-form-urlencoded'}
   
	   }).success(function(data, status, headers, config) {
			   
		   if(data.done == true || data.done == 'true'){
			   
			         // $scope.getTypeNameLov();
     			    //   $scope.Steps=data.steps;
	    			//     $scope.RoutineTypelov=data.typenamelov;
		    		//       $scope.routinetypedata=data.typedata;
		        	 //    $('#RoutineTypeStepsModal').modal('hide');

			      toastr.success(data.msg, '', {timeOut: 3000});

				  window.location.reload();
				  $('#alertroutinemodal').modal('hide');

			   // $scope.routinename.ID = data.ID;
             //				window.location = data.redirect_url;
			   
		   }else{
			   toastr.error(data.msg, '', {timeOut: 3000})
			   $('#alertroutinemodal').modal('hide');

		   }
	   })
	   .error(function(data, status, headers, config) {
	   });
   }

             
		  $scope.remove_routine_type_name = function(){

			// $scope.alertDeleteMsg = 'Are You Sure You want to delete this step';

			// $("#alertDel").modal('show');
			var data = {};
		     
			data.typenameid = $('#routine_type_remove_id').val();
		   //  data.typeid= $scope.routinename.ID;
			data.userId = userId;
			var temp = $.param({details: data});
	   $http({
		   data: temp+"&"+$scope.tokenHash, 
		   url : site+"/remove_routine_type_name",
		   method: "POST",
		   async: false,
		   headers: {'Content-Type': 'application/x-www-form-urlencoded'}
   
	   }).success(function(data, status, headers, config) {
			   
		   if(data.done == true || data.done == 'true'){
			   
			      // $scope.getTypeNameLov();
			      $scope.Steps=data.steps;
				    $scope.RoutineTypelov=data.typenamelov;
				      $scope.routinetypedata=data.typedata;

				// 	  setTimeout(function(){
				// 		var table = $('#steps_table').DataTable();
				// 		table.destroy();
				// 		var table = $('#type_table').DataTable();
				// 		table.destroy();
		
				// 		$('#steps_table').DataTable( {
				// 		   order: [],
				// 		   aLengthMenu: [
				// 						 [10, 25, 50, 100, 200, -1],
				// 						 [10, 25, 50, 100, 200, "All"]
				// 					 ]
				// 	   } );
				// 	   $('#type_table').DataTable( {
				// 		order: [],
				// 		aLengthMenu: [
				// 					  [10, 25, 50, 100, 200, -1],
				// 					  [10, 25, 50, 100, 200, "All"]
				// 				  ]
				// 	} );
				//    }, 1000);
		    	 //    $('#RoutineTypeStepsModal').modal('hide');
   
			      toastr.success(data.msg, '', {timeOut: 3000})
				  $('#alertroutinetypemodal').modal('hide');

			   // $scope.routinename.ID = data.ID;
             //				window.location = data.redirect_url;
			   
		   }else{
			   toastr.error(data.msg, '', {timeOut: 3000})
			   $('#alertroutinetypemodal').modal('hide');

		   }
	   })
	   .error(function(data, status, headers, config) {
	   });
   }



		$scope.removestep = function(){

			// $scope.alertDeleteMsg = 'Are You Sure You want to delete this step';

			// $("#alertDel").modal('show');
			var data = {};
		     
			data.stepid = $('#step_remove_id').val();
		   //  data.typeid= $scope.routinename.ID;
			data.userId = userId;
			var temp = $.param({details: data});
	   $http({
		   data: temp+"&"+$scope.tokenHash, 
		   url : site+"/removesteps",
		   method: "POST",
		   async: false,
		   headers: {'Content-Type': 'application/x-www-form-urlencoded'}
   
	   }).success(function(data, status, headers, config) {
			   
		   if(data.done == true || data.done == 'true'){
			   
			    // $scope.getTypeNameLov();
			    $scope.Steps=data.steps;
			// 	setTimeout(function(){
			// 		var table = $('#steps_table').DataTable();
			// 		table.destroy();
	
			// 		$('#steps_table').DataTable( {
			// 		   order: [],
			// 		   aLengthMenu: [
			// 						 [10, 25, 50, 100, 200, -1],
			// 						 [10, 25, 50, 100, 200, "All"]
			// 					 ]
			// 	   } );
			//    }, 2000);
		    	//    $('#RoutineTypeStepsModal').modal('hide');
   			 $('#alertsteps').modal('hide');

			   toastr.success(data.msg, '', {timeOut: 3000})
   
			   // $scope.routinename.ID = data.ID;
   //				window.location = data.redirect_url;
			   
		   }else{
			   toastr.error(data.msg, '', {timeOut: 3000})
			   $('#alertsteps').modal('hide');

		   }
	   })
	   .error(function(data, status, headers, config) {
	   });
   }

	$scope.addstep = function(){
		
		 var data = {};
		 data.routinetype = $scope.product;
		//  data.typeid= $scope.routinename.ID;
		 data.userId = userId;
		 var temp = $.param({details: data});
	$http({
		data: temp+"&"+$scope.tokenHash, 
		url : site+"/addstep_routine",
		method: "POST",
		async: false,
		headers: {'Content-Type': 'application/x-www-form-urlencoded'}

	}).success(function(data, status, headers, config) {
			
		if(data.done == true || data.done == 'true'){
			
			// $scope.getTypeNameLov();
			$scope.Steps=data.steps;
			$('#RoutineTypeStepsModal').modal('hide');
			$scope.product.P_7 ="";
			toastr.success(data.msg, '', {timeOut: 3000});

		// 	setTimeout(function(){
		// 	  $('#steps_table').DataTable().destroy();
				
		// 	   $('#steps_table').DataTable( {
		// 		order: [],
		// 		aLengthMenu: [
		// 					  [10, 25, 50, 100, 200, -1],
		// 					  [10, 25, 50, 100, 200, "All"]
		// 				  ]
		// 	} );
		//    }, 500);

			// $scope.routinename.ID = data.ID;
//				window.location = data.redirect_url;
			
		}else{
			toastr.error(data.msg, '', {timeOut: 3000})
		}
	})
	.error(function(data, status, headers, config) {
	});
}

	$scope.saveTypename = function(){
		
	    	var data = {};
			
	        data.routinetype = $scope.routinetype;
			data.typeid= $scope.routinename.ID;
	        data.userId = userId;
    	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/add_routine_type_name",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				// $scope.getTypeNameLov();
				$scope.RoutineTypelov=data.typenamelov;
				$scope.routinetypedata=data.typedata;

				$('#RoutineTypeModal').modal('hide');
			// 	setTimeout(function(){
			// 	$('#type_table').DataTable().destroy();
				
			// 	$('#type_table').DataTable( {
			// 	 order: [],
			// 	 aLengthMenu: [
			// 				   [10, 25, 50, 100, 200, -1],
			// 				   [10, 25, 50, 100, 200, "All"]
			// 			   ]
			//  } );
			// }, 1000);

				toastr.success(data.msg, '', {timeOut: 3000})

				// $scope.routinename.ID = data.ID;
//				window.location = data.redirect_url;
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.addtype =function(){
		$scope.routinetype.C_1= "" ;
		$scope.routinetype.ID="";
		$('#RoutineTypeModal').modal('show');

	}

	$scope.continuetypename = function(id){
		
		 var data = {};
	     data.recordId = id;
	     data.userId = userId;


    	 var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/routine_type_name_edit",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			var details = data.typename;
            $scope.routinetype.C_1= details['name'] ;
			$scope.routinetype.ID= details['ID'];

			$('#RoutineTypeModal').modal('show');
			
		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.continouRecord = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.userId = userId;
		$scope.RoutineTypelov={};
		$scope.routinetypedata={};
		$scope.Steps={};



    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/routine_type_edit",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			var details = data.details;
			var images = data.images;
			
			$("#p_att").html('');
			
			if(details != '' && details != null){
				
				if ($.fn.DataTable.isDataTable("#steps_table")) {
					$('#steps_table').DataTable().clear().destroy();
				}
	
				if ($.fn.DataTable.isDataTable("#type_table")) {
					$('#type_table').DataTable().clear().destroy();
				}


				 $scope.editView = 1;
				 $scope.routinename.ID = details['ID'];
				 $scope.routinename.P_1 = details['NAME'];
				 // $scope.routinename.P_2 = details['QUANTITY'];
				 $scope.routinename.P_3 = details['IDENTIFY'];
				 $scope.routinename.P_4 = details['DESCRIPTION'];
                  if(data.typenamelov){
					$scope.RoutineTypelov=data.typenamelov;
				  }
				  if(data.alltypenamedata){
					$scope.routinetypedata=data.alltypenamedata;
				  }
				  if(data.steps){
					$scope.Steps=data.steps;
				  }
				 console.log(data);
				
				setTimeout(function(){
					$("#quantity_in_stock").val($scope.routinename.P_2).trigger('change');
					$(".summernote").summernote("code", $scope.routinename.P_4);
				}, 500);


				setTimeout(function(){
		
				
					$('#steps_table').DataTable( {
					   order: [],
					   aLengthMenu: [
									 [10, 25, 50, 100, 200, -1],
									 [10, 25, 50, 100, 200, "All"]
								 ]
					} );
					$('#type_table').DataTable( {
						order: [],
						aLengthMenu: [
									[10, 25, 50, 100, 200, -1],
									[10, 25, 50, 100, 200, "All"]
								]
					} );
				}, 1000);
			}

			
			
			if(images != '' && images != null){
			 
                // for(var i=0; i<images.length; i++){
		
					var html = '<div class="col-2  margin-r1 img_remove" id="img_file_'+images["ID"]+'">'+
									'<img src="'+images["downPath"]+'" alt="" class="image-box">'+
									'<div class="overlay">'+
										'<div class="text">';
											
										    // '<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deletePic('+images["ID"]+')" title="Delete Image">';	
											// if(images[i]["primFlag"] == '0'){
											// 	html += '<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markPrimary('+images[i]["ID"]+')" title="Mark Primary">';	
											// }
											
										html += 
										// '<div class="arrow-icon-move-box">'+
										// 		'<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
										// 		'<p>Move Position</p>'+
										// 	'</div>'+
										'</div>'+
									'</div>'+
								'</div>';
						 $("#p_att").append($compile(angular.element(html))($scope));
				// }
			}
		 })
		 .error(function(data, status, headers, config) {
		 });
	 }

	 // $scope.markPrimary = function(id){
		
// 		var data = {};
// 	    data.recordId = id;
// 	    data.ingredientId = $scope.routinename.ID;
// 	    data.userId = userId;
//     	var temp = $.param({details: data});
    	
// 		$http({
// 			data: temp+"&"+$scope.tokenHash,
// 			url : site+"/markPrimaryIngredientAttachment",
// 			method: "POST",
// 			async: false,
// 			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

// 		}).success(function(data, status, headers, config) {
				
// 			toastr.success(data.msg, '', {timeOut: 3000})
			
// 			var images = data.images;
			
// 			$("#p_att").html('');
			
// 			if(images != '' && images != null){
// 				for(var i=0; i<images.length; i++){
					
// 					var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+images[i]["ID"]+'">'+
// 									'<img src="'+images[i]["downPath"]+'" alt="" class="image-box">'+
// 									'<div class="overlay">'+
// 										'<div class="text">'+
// 											'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deletePic('+images[i]["ID"]+')" title="Delete Image">';
											
// 											if(images[i]["primFlag"] == '0'){
// 												html += '<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markPrimary('+images[i]["ID"]+')" title="Mark Primary">';	
// 											}
											
// 									html += '<div class="arrow-icon-move-box">'+
// 												'<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
// 												'<p>Move Position</p>'+
// 											'</div>'+
// 										'</div>'+
// 									'</div>'+
// 								'</div>';
						
// 						$("#p_att").append($compile(angular.element(html))($scope));
// 				}
// 			}
			
// 		})
// 		.error(function(data, status, headers, config) {
// 		});
// 	}
	$scope.deletePic = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.ingredientId = $scope.routinename.ID;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteIngredientAttachment",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			toastr.success(data.msg, '', {timeOut: 3000})
			
			var images = data.images;
			
			$("#p_att").html('');
			
			if(images != '' && images != null){
				for(var i=0; i<images.length; i++){
					
					var html = '<div class="col-2 image-overlay margin-r1 img_remove" id="img_file_'+images[i]["ID"]+'">'+
									'<img src="'+images[i]["downPath"]+'" alt="" class="image-box">'+
									'<div class="overlay">'+
										'<div class="text">';
											// '<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deletePic('+images[i]["ID"]+')" title="Delete Image">';
					
											// if(images[i]["primFlag"] == '0'){
											// 	html += '<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markPrimary('+images[i]["ID"]+')" title="Mark Primary">';	
											// }
					
									html += 
									// '<div class="arrow-icon-move-box">'+
												// '<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
												// '<p>Move Position</p>'+
											// '</div>'+
										'</div>'+
									'</div>'+
								'</div>';
						
						$("#p_att").append($compile(angular.element(html))($scope));
				}
			}
			
		}).error(function(data, status, headers, config) {
		});
	}

	$scope.statusChange = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/changeStatusRoutineType",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			toastr.success(data.msg, '', {timeOut: 3000})
			$scope.getAllAdminRoutinenamelov();
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.alertDeleteMsg = '';
	$scope.deleteIngredient = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteIngredient",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.getAllAdminRoutinenamelov();
				
			}else{
			
				$scope.alertDeleteMsg = data.msg;
				$("#alertDel").modal('show');
			}
			
		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.closealertDeleteModal = function(id) {
          
		  alert(id);
		  $("#"+id).modal('hide');		
	}


	$('#uploadattch').fileupload({
		
 		add: function (e, data) {
 		    
 			if($scope.routinename.ID == ""){
 				
 				toastr.error('Save record first, then upload Images...', '', {timeOut: 3000})
 				return false;
 			
 			}else{
 				$.LoadingOverlay("show"); 
 				var jqXHR = data.submit();
 			}
 	    },
 		beforeSend: function() {

 		},
 	    uploadProgress: function(event, position, total, percentComplete) {

 	    },
 	    success: function() {

 	    },
 	    complete: function(xhr) {

 	    	setTimeout(function(){
				$.LoadingOverlay("hide");
			}, 500);
 	    	
 	    	xhr.responseText = jQuery.parseJSON(xhr.responseText);
 	      	
 	    	if(xhr.responseText[0] == 01){
 	        	
 	      		toastr.error("Error: Invalid File Format", '', {timeOut: 3000});

 	      	}else if(xhr.responseText[0] == 02){
 	        	
 	      		toastr.error("Error : Unable To upload", '', {timeOut: 3000});

 	      	}else if(xhr.responseText[0] == 03){
 	        
 	      		toastr.error("Error : Save record first, then upload Images...", '', {timeOut: 3000});

 	      	}else if(xhr.responseText[0] == 04){
 	        
 	      		toastr.error("Error : Image dimension must be minimum 125 X 125", '', {timeOut: 3000});

 	      	}else{
                 
				$('.img_remove').remove();
 		  		 toastr.success("Image Upload Successfully", '', {timeOut: 3000});
 			    
 		  		var html = '<div class="col-2  margin-r1 img_remove" id="img_file_'+xhr.responseText[1]+'">'+
								'<img src="'+xhr.responseText[2]+'" alt="" class="image-box">'+
								'<div class="overlay">'+
									'<div class="text">'
										// '<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deletePic('+xhr.responseText[1]+')" title="Delete Image">'+
										// '<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markPrimary('+xhr.responseText[1]+')" title="Mark Primary">'+	
										// '<div class="arrow-icon-move-box">'+
										// 	// '<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
										// 	// '<p>Move Position</p>'+
										// '</div>'+
									'</div>'+
								'</div>'+
							'</div>';
 		  		
 		  		$("#p_att").append($compile(angular.element(html))($scope));
				
				   $scope.$apply(() => {
 		        		  
					$scope.editView = 0;
					$scope.getAllAdminRoutinenamelov();
					});
				  
 	      	}
 	   	}
 	});
		
	
})
.config(function ($httpProvider, $provide) {
	$provide.factory('httpInterceptor', function ($q, $rootScope) {
		return {
			'request': function (config) {
                $.LoadingOverlay("show"); 

				$rootScope.$broadcast('httpRequest', config);
				return config || $q.when(config);
			},
			'response': function (response) {
				setTimeout(function(){
					$.LoadingOverlay("hide");
				}, 500);
				if(typeof response.data != 'object'){ //might have some error

					var temp = response.data.toLowerCase();
					if(temp.indexOf("error") >= 0){  //result may have error
						console.log("Response is not obj and has Error");
						$("div#error").html(response.data);
						jQuery("#errorModal").modal('show');
						return
					}

				}
				$rootScope.$broadcast('httpResponse', response);
				return response || $q.when(response);
			},
			'requestError': function (rejection) {
				console.log("requestError");
                $.LoadingOverlay("hide"); 
				$("div#error").html(rejection.data);
				jQuery("#errorModal").modal('show');
				$rootScope.$broadcast('httpRequestError', rejection);
				return $q.reject(rejection);
			},
			'responseError': function (rejection) {
				setTimeout(function(){
					$.LoadingOverlay("hide");
				}, 500);
				console.log("responseError");
				$("div#error").html(rejection.data);
				jQuery("#errorModal").modal('show');
				$rootScope.$broadcast('httpResponseError', rejection);
				return $q.reject(rejection);
			}
		};
	});
	$httpProvider.interceptors.push('httpInterceptor');
})


// 	$('#searchInListing').on("keyup", function (e)  {     
//            var tr = $('.identify');
//            
//            if ($(this).val().length >= 1) {//character limit in search box.
//                var noElem = true;
//                var val = $.trim(this.value).toLowerCase();
//                el = tr.filter(function() {
//                    return $(this).find('.grid-p-searchby').text().toLowerCase().match(val);
//                });
//                if (el.length >= 1) {
//                    noElem = false;
//                }
//                if(el.length<1) {
////    		            	$('#tabContentNoData').show();
//                } else {
////    		            	$('#tabContentNoData').hide();
////    		            	$('#tabContentData').show();
//                	}
//                tr.not(el).hide();
//                el.fadeIn();
//            } else {
//                tr.fadeIn();
//                if(veiwMoreShowGlobal==true){
//                }
//                else{
//                }
////    	            	$('#tabContentNoData').hide();
//                       
//            }
//        });




		
		
		
