$(document).ready(function(e){

  let currentpath = location.pathname;

  $('#payment_mode').hide();

  $('#phone_num').keyup(function(){
    $(this).val($(this).val().replace(/^0+/, ""))
  })

    //when the select input changes
    //listen for the change in value
    $('#payment_type').change(function(){
      //get the value that is being switched to
      let selected_mode = $(this).children("option:selected").val();

      if(selected_mode == "Cash"){//if it is by mode of cash
        $('#payment_mode').show();//show the input for mode of payment
      }else{
        $('#payment_mode').hide(); //hide it
      }
    });

    function error(message){
        $.toast({
            text: `<div class="alert alert-danger d-flex justify-content-center align-items-center" style="height:50px">${message}</div>`,
            showHideTransition: 'fade',
            hideAfter: 3000,
            position: 'top-center',
            bgColor: 'red',
            allowToastClose: true,

        });
    }

    function success(message) {
        $.toast({
            text: `<div class="alert alert-success d-flex justify-content-center align-items-center" style="height:50px">${message}</div>`,
            showHideTransition: 'fade',
            hideAfter: 3000,
            position: 'top-center',
            bgColor: 'green',
            allowToastClose: true,
        });
    }

    $('#select_rider_input').change(function(){
      let selected_value_data = $(this).children("option:selected").data('rider');
      //console.log("nothing selected " + selected_value_data);
      if (selected_value_data == undefined){
            console.log("nothing selected ");
            $('#brand_name14').val("")
            $('#rider_details123').val("");
            $('#reg_number').val("")
      } else {
            $('#brand_name14').val(selected_value_data['brand_name'])
            $('#rider_details123').val(JSON.stringify($(this).children("option:selected").data('rider')));
            $('#reg_number').val(selected_value_data['registered_number'])
      }
    });

    $('#manual_record_form_button').on('click',function (event){
        const btntext = $(this).text();
        //console.log(btntext);
        if (btntext == "submit"){
            sendManualForm('manual_record_form', 'phone_num', '#manual_record_modal', '/upload_manual_record');
        } else {
            sendManualForm('manual_record_form', 'phone_num', '#manual_record_modal','/update_schedule_record');
        }
    });

     function sendManualForm(formclassname, phoneinputid, modalid, routingpath){
         const isValidated = validateForms(formclassname, event);
         if ($('#' + phoneinputid).val().length > 9 || $('#' + phoneinputid).val().length < 9) {
             error('Contact number must be 9 characters without the preceeding 0');
             return;
         } else {
             if (isValidated == true) {
                 let isrequestback = postInformation('.'+formclassname,
                     modalid,
                     routingpath);
             } else {
                //  nowuiDashboards.showNotification('top', 'right', 'primary', '');
                 error("Fill out all mandatory fields");
             }
         }
     }


    $('#manual_cancel').on('click', function(){
          $('.manual_record_form').trigger("reset");
        $('#modal_title_details').text('Add manuel record');
        $('#manual_record_form_button').text('submit');
    });

    $('#initialregisterbtn').on('click', ()=> {$('.rideregistrationforms').modal('show')});


    $('#ridersubmitbtn').on('click', (event) => {
       let formvalid =  validateForms('needs-validation', event);
        if (formvalid == true){
            $('.rideregistrationforms').modal('hide');
            let isrequestback = postInformation('.needs-validation',
            '.rideregistrationforms',
            '/registerrider');

        } else {
            error('Fill out all mandatory fields');
        }
    });

    $('.registerridebtn').on('click', function(e){
        let formvalidate = validateForms('ridesformsval', e);
        if (formvalidate == true){
            postInformation('.ridesformsval', '.bd-rideform-modal-lg','/registerride');
        } else {
            error('Fill out all mandatory fields');
        }
    });

    $('.assignridebtn').on('click', function (e) {
        let assignform = validateForms('assignform', e);
        if (assignform == true) {
            postInformation('.assignform', '.bd-assignride-modal-sm','/assignedmotrorbiketorider');
        }
    });






    function postInformation(inputforms,optionalmodal = null , url){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(optionalmodal).modal('hide');
        $('.modal-backdrop').remove();
        $('#loaderModal').modal('show');
        $.ajax({
            method: 'POST',
            url: url,
            data: $(inputforms).serialize(),
            success: function(data){
                $(inputforms).trigger('reset');
                // nowuiDashboards.showNotification('top', 'right', 'success',  data.success);
                $.toast({
                    text: `<div class="alert alert-success d-flex justify-content-center align-items-center" style="height:50px">${data.success}</div>`,
                    showHideTransition: 'slide',
                    hideAfter: 3000,
                    position: 'top-center',
                    bgColor: 'green',
                    allowToastClose: true,

                });
                $('#loaderModal').remove();
                $('.modal-backdrop').remove();


            },
            error: function (error){
                $('#loaderModal').remove();
                $(optionalmodal).modal('show');
                $.toast({
                    text: `<div class="alert alert-danger d-flex justify-content-center align-items-center" style="height:50px">${error.error}</div>`,
                    showHideTransition: 'slide',
                    hideAfter: 3000,
                    position: 'top-center',
                    bgColor: 'red',
                    allowToastClose: true,

                });
                // nowuiDashboards.showNotification('top', 'right', 'danger', error.error);

            }
        });
    }

    let riderinfo = $('#ridersoutputtable').DataTable({
        'ajax' : '/getridersinformation',
         'deferRender': true
    });

    $('#companyclientstable').DataTable({
        'ajax': '/fetchCompanyClients',
        'deferRender': true
    });

    let riderfound_id = "";

    $('#ridersoutputtable').on('click','.singleriderbtn', function(){
        riderfound_id = $(this).data('riderid');
        // console.log(riderfound_id);
        // location.href = /aboutriders/ + riderfound_id;
    });


    $('.addclientbtn').click(function(e){
        $('#client_record_modal').modal('show');
    });


    (function(){
        if (location.pathname.substring(1, 12) == "aboutriders"){
            riderfound_id = location.pathname.substring(13);
        }
    })();

    if(riderfound_id != ""){
        let singleriderinfo = $('#riderstable').DataTable({
            'ajax': '/getsingleriderinformation/' + riderfound_id,
            'deferRender': true,
            'searching':false,
            'destroy':true
        });
    }


    $('.querydatabtn').on('click', function(e){
        e.preventDefault();
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: 'POST',
            url: '/queryCompanyTransactionData',
            data: $('#reportforms').serialize(),
            success: function(data){
                $('#reportstable').DataTable().destroy();
                $('#reportstable').DataTable({
                    data: data.data,
                    'deferRender': true,
                    'dom': 'Bfrtip',
                    'buttons': [
                        'copy',
                        'excel',
                        'csv',
                        'pdf',
                        'print'
                    ]
                })
                $('#totalresult').text("GHC " + data.total);
                $('#totalcommission').text("GHC " + data.commision);
            },
            error: function(error){
            }
        });

    });


    (function(){
        let today = new Date();
        $('#mainemptitle').html("Employees current activities for " + today.getFullYear() + "-" + (today.getMonth()+1) + "-" + today.getDate());
    })();


    var firebaseConfig = {
        apiKey: "AIzaSyCG0zoNGxI_QNvlsnFxWeENc6S7frpR4TE",
        authDomain: "delipack-2d2ca.firebaseapp.com",
        databaseURL: "https://delipack-2d2ca.firebaseio.com",
        projectId: "delipack-2d2ca",
        storageBucket: "delipack-2d2ca.appspot.com",
        messagingSenderId: "636386670726",
        appId: "1:636386670726:web:97c67f0f90e2d761"
      };
      let app = firebase.initializeApp(firebaseConfig);








    $('#employeecurrentactivitytable').on('click','.viewtodaysalesbtn',function(){
        $('#tripssum').text(0);
        $('#salessum').text(0);
        $('#commissionsum').text(0);
        $('#totalsale').text(0);
        $('#exampleModalCenter').modal('show');
        let today = new Date();
        $('#exampleModalLongTitle').html($(this).parent().parent().find('#ridernameid').text() + " sales <br>" +
        "Date: " + today.getFullYear() + "-" + (today.getMonth()+1) + "-" +  today.getDate() + "<br> Time: " + today.getHours() + ":" + today.getMinutes()  );
        $.ajax({
            method:'GET',
            url: '/getridersalesdfortoday/' + $(this).data('riderid'),
            success: function(data){
                $('#tripssum').text(data[0]);
                $('#salessum').text(data[1]);
                $('#commissionsum').text(data[2]);
                $('#totalsale').text(data[3]);
            },
        });

    });



    $('#transactionstable').on('click','.quickviewButton',function(){
        let dataitemobj = $(this).data('transactions');
        $('#rating_tag').barrating('destroy');
        $('#transaction_title').text("From: " + dataitemobj.source + " To: " + dataitemobj.destination);
        $('#transaction_number').text(dataitemobj.transaction_number);
        $('#created_at').text(dataitemobj.paidon);
        $('#brand_name').text(dataitemobj.brand_name);
        // $('#rating').text(dataitemobj.rate_value);
        //console.log(parseInt(dataitemobj.rate_value));
            $('#rating_tag').barrating({
              theme: 'fontawesome-stars',
              initialRating: parseInt(dataitemobj.rate_value),
              readonly: 'true'
            });
        $('#registered_number').text(dataitemobj.registered_number);
        $('#delivery_fee').text(dataitemobj.delivery_charge);
        $('#commission').text(dataitemobj.commission_charge);
        $('#transtotal').text(dataitemobj.total_charge);
        $('#customerfirstname').val(dataitemobj.customerFirstName);
        $('#customerlastname').val(dataitemobj.customerLastName);
        $('#customerphonenumber').val(dataitemobj.customerPhoneNumber);
        $('#riderFirstName').val(dataitemobj.ridersFirstName);
        $('#riderLastName').val(dataitemobj.ridersLastName);
        $('#personalnumber').val(dataitemobj.personal_phone);
        $('#worknumber').val(dataitemobj.work_phone);
        $('#pickup').val(dataitemobj.source);
        $('#delivery').val(dataitemobj.destination);
        $('#deliverystatus').val(dataitemobj.delivery_status);
        if(dataitemobj.delivery_status == "CANCELLED"){
            $('#deliverystatus').css({
                'background-color':'#b30000',
                'color': 'white'
            });
        }else if(dataitemobj.delivery_status == "ACTIVE"){
            $('#deliverystatus').css({
                'background-color':'#009900',
                'color': 'white'
            });
        }
        $('.bd-quickview-modal-lg').modal('show');
    });

    let ridesinfo = $('#ridestable').DataTable({
        'ajax': '/gerregrides',
        'deferRender': true
      });

    let transactioninfo = $('#transactionstable').DataTable({
        'ajax': '/getTransactionsforcompany',
        'deferRender': true
    });

    const scheduledTransactions = $('#scheduletransactionstable').DataTable({
        'ajax': '/getScheduledDeliveries',
        'defereRender':true
    });


      setInterval(function(){
          if (currentpath == '/rides') {ridesinfo.ajax.reload(null, false);}

          if (currentpath == '/riders'){
            riderinfo.ajax.reload(null, false);
          }

          if (currentpath == '/deliveries') {
              scheduledTransactions.ajax.reload(null, false);
              transactioninfo.ajax.reload(null, false);
            }
      },3000);




$('.riderprofilebtn').on('click', function(e){
    $('.bd-riderprofile-modal-lg').modal('show');
    let riderid = window.location.pathname.substr(13);
    $('#riderident').val(riderid);
    // return;
    $.ajax({
        method:'GET',
        url: '/editriderinformation/'+riderid
    }).done(function (data){
        let othername = "";
        (data.other_name) ? othername = data.other_name : othername;
        $('#user_full_name').text(data.first_name + " " + othername + " " + data.last_name);
        $('#user_access').text(data.personal_phone);
        $('#edit_first_name').val(data.first_name);
        $('#edit_other_name').val(data.other_name);
        $('#edit_last_name').val(data.last_name);
        $('#edit_personal_phone').val(data.personal_phone);
        $('#edit_work_phone').val(data.work_phone);
        $('#edit_gender').val(data.gender);
        $('#edit_about_me').val(data.about);
        $('#edit_address').val(data.address);
        $('#edit_region').val(data.region);
        $('#edit_city').val(data.city);
        $('#edit_area').val(data.area);
        $('#edit_license_class').val(data.License_type);
        $('#edit_license_number').val(data.License_number);
        $('#edit_expiry_date').val(data.Expiry_date);
        $('#edit_date_of_issue').val(data.date_of_issue);

        // $('#user_about')
        let description = data.about.split(" ");
        if (description.length > 1){

        } else {

        }
    })
});

    $('.ridereditinfobtn').on('click', function (e){
        let isvalidated = validateForms('editridersinformation', e);
        if (isvalidated == true){
            postInformation('.editridersinformation', '.bd-riderprofile-modal-lg','/editridersprofile');
        }
    });



    $('#ridersoutputtable').on('click','.assignride', function(){
        let btntxt = String($(this).html().trim());
        let unassignobj = {};
        unassignobj["rider_id"] = $(this).attr("id");

        if (btntxt.length == 6){
            updateAssignmentBike();
            $('.bd-assignride-modal-sm').modal('show');
            $('#assigncmp_rider').val($(this).attr('id'));
            //console.log($('#assigncmp_rider').val());
        } else if(btntxt.length == 8 ){
            Swal.fire({
                title: 'Are you sure?',
                text: "You want unassign Rider from Bike!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Unassign!'
            }).then((result) => {
                if (result.value) {
                    postInformation(unassignobj,'','','','/unassignedmotorbike');
                    Swal.fire(
                        'Unassigned!',
                        'Rider has been unassigned.',
                        'success'
                    )
                    // location.reload();
                }
            })
        }
    });


    // rider edit function
    $('#ridestable').on('click', '.editmotor', function (e){
        $('.bd-rideeditform-modal-lg').modal('show');
        let motor_id = $(this).attr('id');
        $('#bike_ident').val(motor_id);
        $.ajax({
            method: 'GET',
            url: '/editmotorinformation/'+ motor_id
        }).done(function(data){
            $('#brand_name').val(data.brand_name);
            $('#registered_number').val(data.registered_number);
            $('#date_of_registration').val(data.date_of_registration);
            $('#date_of_expiry').val(data.date_of_expiry);
        });
    });


    $('#home-tab').click(function(){
        $('#home').show();
        $('#profile').hide();
    });

    $('#profile-tab').click(function () {
        $('#home').hide();
        $('#profile').show();
    });

    //send editted information
    $('.editridebtn').on('click', function(event){
        let isvalidated = validateForms('editrideform',event);
        if (isvalidated == true){
            postInformation('.editrideform', '.bd-rideeditform-modal-lg', '/editrideinformation');
        }
    });



    $.ajax({
        method: 'GET',
        url: '/getridersinformation',
    }).done(function(data){
    });


    // setInterval(getridersinformationjs,1000);

    // riderstable.buttons().container().appendTo($('div.eight.column:eq(0)', riderstable.table().`container`()));


    function validateForms(classname, event){
        let forms = document.getElementsByClassName(classname);
        let isvalid = false;
        Array.prototype.filter.call(forms, function (form) {
            if (form.checkValidity() == false) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add('was-validated');
                isvalid = false;
            } else {
                isvalid = true;
            }
        });

       return isvalid;
    }


    //Deactivating riders

    $('#riderTable').on('click', '.deactivateRiderBtn', function () {
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You want deactivate Rider!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, deactivate!'
        }).then((result) =>{
            if(result.value){
                $.ajax({
                    method: 'GET',
                    url: `/deactivteRider/${id}`,
                }).done(function (data) {
                    error(data);
                });
            }
        })
    });

function updateAssignmentBike(){
    $.ajax({
        method: 'GET',
        url: '/getcompanybikesforassignment',
        success: function (data) {
            $('#ridesselecttag').empty();
            $('<option>')
                .text('Select Bike')
                .appendTo('#ridesselecttag');
            $.each(data, function (value, index) {
                $('<option>').val(index.bike_id)
                    .text(index.brand_name + " " + index.registered_number)
                    .appendTo('#ridesselecttag');
            });
        }
    })
}

$('.addride').click(function(){
    $('.bd-rideform-modal-lg').modal('show');
});

// setInterval(updateAssignmentBike, 3000);


    //Delete Motor Bike from the list
    $('#ridestable').on('click', '.motorBikeDeleteBtn', function () {
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You want delete bike!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: 'GET',
                    url: `/deleteBike/${id}`,
                }).done(function (data) {
                    error(data);
                });
            }
        })
    });



    const availablekeysarray = [];
    const availablevalsarray = [];
    const availablecss = {
        "backgroundColor": "green",
        "color": "white",
        "padding": "5px",
        "borderRadius": "5px 5px 5px 5px"
    }

    const workingcss = {
        "backgroundColor": "#fd7e14",
        "color": "white",
        "padding": "5px",
        "borderRadius": "5px 5px 5px 5px"
    }

    const unavailablecss = {
        "backgroundColor": "#a6a6a6",
        "color": "white",
        "padding": "5px",
        "borderRadius": "5px 5px 5px 5px"
    }

    function checkRiderStatus() {
        const mapleyval = new Set();
        $.ajax({
            method:"GET",
            url:"/getcompanyridersids",
            success: function(data){
                //console.log(data);
                const riderlocationavailable = firebase.database().ref().child('RiderLocationAvailable');
                const riderworking = firebase.database().ref().child("RiderFoundForCustomer");
                riderlocationavailable.on('child_added', function (snapshot) {
                    $.each(data, function (i) {
                        if (snapshot.key.includes(data[i])) {
                            $('#status' + snapshot.key).children().text("Available").css(availablecss);
                            const obj = {};
                            obj["lat"] = snapshot.val().l[0];
                            obj["lng"] = snapshot.val().l[1];
                            mapleyval.add(obj);

                        }
                    });

                    riderlocationavailable.on('child_removed', function (snap) {
                        $('#status' + snap.key).children().text("Unavailable").css(unavailablecss);
                        riderlocationavailable.on('child_removed').off();
                    });
                });



                riderworking.on('child_added', function (snap) {
                    $.each(data, function (index) {
                        if (snap.key.includes(data[index])) {
                            $('#status' + snap.key).children().text("On-errand").css(workingcss);
                        }
                    });

                    riderworking.on('child_removed', function (snap) {
                        $('#status' + snap.key).children().text("Unavailable").css(unavailablecss);
                        riderworking.on('child_removed').off();
                    });
                });
            }
        });
    }

    if (currentpath == '/maindashboard'){
        setInterval(checkRiderStatus, 1000);
    }







    //change password
    $('#changepassBtn').on('click',function(){
        $('#change_password_modal').modal("show");
    });

    const mandcss ={
        "border":"1px solid red"
    }

    const manresetdcss = {
        "border": "1px solid silver"
    }

    $('#changePassword').on('click',function(){
        let newPass = $('#newPass').val();
        let confirmPass = $('#confirmPass').val();

        if(newPass == "" || confirmPass == ""){
            $('#newPass').css(mandcss);
            $('#confirmPass').css(mandcss);
            return;
        }

        if(newPass.length >= 8){
            if(confirmPass.length >= 8){
                if(confirmPass != newPass){
                    $.toast({
                        text: "Password does not match",
                        showHideTransition: 'slide',
                        hideAfter: 3000
                    });
                    //nowuiDashboards.showNotification('top', 'right', 'danger', "Passwords must match");
                }else{
                    $('#newPass').css(manresetdcss);
                    $('#confirmPass').css(manresetdcss);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        method:"POST",
                        dataType:"JSON",
                        url:"updatepassword",
                        data:$('#changePasswordFrom').serialize(),
                        success:function(data){
                            $('#newPass').css(manresetdcss);
                            $('#confirmPass').css(manresetdcss);
                            success(data);
                            $('#changePasswordFrom').trigger('reset')
                            $('#change_password_modal').modal("hide");
                            setTimeout(function(){
                                $('#logout-form').submit();
                            },2000);
                        },
                        error:function(error){
                            error("Whoops couldn't change your password");
                        }
                    });
                }
            }else{
                $('#confirmPass').css(mandcss);
                $('#newPass').css(manresetdcss);

            }
        }else{
            $('#newPass').css(mandcss);
            $('#confirmPass').css(manresetdcss);

        }
    });

    $('.editClientDetailsBtn').on('click', (e) =>{
        $('.toggleInput').each((value, index) => {
            $(index).removeAttr("readonly");
        });
        $('.emailsmssection').hide();
        $('.emailsmsaction').fadeOut(1000);
        $('#client_record_form_button_more').show();
        // $('#client_record_form_button').text("Send Message");
    });


    $('#clientActionChange').on('change', () => {
        let selection = $("#clientActionChange").children("option:selected").val();
        const getClientEmail = $('#email_more').val();

        if (selection == "Send Email") {
            if(getClientEmail != ""){
                $('.emailsmssection').show();
                $('#clientToggleMore').hide();
                $('#client_record_form_button_more').text("Send Message").show();
                $('.editClientDetailsBtn').hide();
                $('#emailsubject').removeAttr('readonly');
            } else {
                swal.fire({
                    title: "Email Unavailable",
                    text: "Include a valid email for " + $('#client_first_name_more').val() +" to use this feature",
                });
                $('#client_record_form_button_more').text("Submit").hide();

            }
        } else if (selection == "Send SMS"){
            $('.emailsmssection').hide();
             swal.fire({
                 title: "SMS Unavailable",
                 text: "SMS mode not available to you at this moment. Try Again later",
             });
            $('#clientToggleMore').show();
            $('.editClientDetailsBtn').show();
            $('#client_record_form_button_more').text("Submit").hide();

        } else {
            $('.emailsmssection').hide();
            $('#clientToggleMore').show();
            $('.editClientDetailsBtn').show();
            $('#client_record_form_button_more').text("Submit").hide();
        }
    });




    $('#schedule_action_type').change((e)=>{
        let scheduleOption = $('#schedule_action_type').children("option:selected").val();
        //console.log(scheduleOption);
        if (scheduleOption == "Scheduled Delivery") {
            $('.scheduleOption').show();
            $('#schedule_date').attr("required", true);
            $('#schedule_time').attr("required", true);
        } else if (scheduleOption == "Completed Delivery") {
            $('.scheduleOption').hide();
            $('#schedule_date').removeAttr("required");
            $('#schedule_time').removeAttr("required");
        } else {
            $('.scheduleOption').hide();
            $('#schedule_date').removeAttr("required");
            $('#schedule_time').removeAttr("required");
        }
    });


    $('#client_record_form_button').on('click', (e) => {
        const isClientRecorded =  validateForms('client_record_form', e);
        //console.log(isClientRecorded);
        if (isClientRecorded == true){
            postInformation('.client_record_form',
            '#client_record_modal',
            '/client_record');
        } else {
            error('Fill out all mandatory fields');
            //console.log("Error");
        }
    });

    $('#clientTable').on('click','.clientMoreBtn',function(e){
        e.preventDefault();
        $('#client_record_form_button_more').hide();
        $('#more_client_modal').modal({
            backdrop:'static',
            keyboard:false
        });
        const alt_num = "";

        console.log($('#client_first_name_more').val());

        const selectOption = $('#clientActionChange').val();
        console.log(selectOption);
        if (selectOption != "No Action"){
            $('.emailsmssection').hide();
            $('#clientToggleMore').show();
            $('.editClientDetailsBtn').show();
            $('#client_record_form_button').text("Submit");
            $('#clientActionChange').val("No Action");
        }


        const clientDetails = $(this).data('clients');

        $('#clientDetailsName').text("Edit " + clientDetails.client_first_name + " " + clientDetails.client_last_name + "'s" + " Details");
        $('#client_first_name_more').val(clientDetails.client_first_name);
        $('#client_last_name_more').val(clientDetails.client_last_name);
        $('#client_contact_number_more').val(fixNumber(clientDetails.client_primary_number));
        $('#client_contact_number_two_more').val(clientDetails.client_alt_number);
        $('#email_more').val(clientDetails.email_address);
        $('#customer_location_more').val(clientDetails.location);
        $('#company_name_more').val(clientDetails.company_name);
        $('#clientSendEmailAddress').val(clientDetails.email_address);
        $('#company_client_id_more').val(clientDetails.company_clients_id);
        //console.log(clientDetails.company_clients_id);

    });

    $('#manual_cancel_more').on('click', function () {
        $('.client_record_form_more').trigger("reset");
        $('.toggleInput').each((value, index) => {
            $(index).attr("readonly", true);
        });
        $('.emailsmsaction').show();
        $('#client_record_form_button_more').show();

    });


    $('#client_record_form_button_more').on('click', function(e){
        const btn_content = $(this).text();
        //console.log(btn_content);
        if(btn_content == "Submit"){
            sendManualForm('client_record_form_more', 'client_contact_number_more', '#more_client_modal','/updateClientData');
        }else if (btn_content == "Send Message") {
            //email to be written
        }
    });




    $('#known_clients_input').on('input',function(){
        const f_value = $(this).val();
        const d_value = $('#known_clients [value="' + f_value + '"]').data('companyclients');
        //console.log(f_value);
        if(f_value == ""){
            $('#client_identification').val("-1");
            $('#phone_num').val("");
        } else {
            //console.log($(this) );
            if (d_value == undefined){
                $('#client_identification').val("-1");
                $('#phone_num').val("");
            } else{
                let client_phone = Array.from(d_value.client_primary_number).slice(1, 10).join("");
                $('#phone_num').val(client_phone);
                $('#client_identification').val(d_value.company_clients_id);
            }
        }
    });

    $('.modal').attr('data-backdrop','modal-backdrop');

    $('#scheduletransactionstable').on('click','.updateScheduleDelivery', function (){

        $('#manual_record_modal').modal({
            backdrop: 'static',
            keyboard: false
        });

        const client_data = $(this).data('clients');
        const rider_name = client_data.first_name + " " + client_data.last_name;
        const client_name = client_data.client_first_name + " " + client_data.client_last_name;
        const payment_type = client_data.payment_type;
        const schedule_action = client_data.delivery_status;
        const riderdet = JSON.stringify({
            bike_id:client_data.bike_id,
            brand_name: client_data.brand_name,
            registered_number: client_data.registered_number,
            company_rider_id: client_data.company_rider_id,
            company_id: client_data.companiescompanies_id,
            first_name: client_data.first_name,
            last_name: client_data.last_name
        });


        $('#manual_record_form_button').text('Update schedule');
        $('#modal_title_details').text('Update Schedule for ' + client_data.client_first_name + " " + client_data.client_last_name);
        $("#select_rider_input option[value='" + client_data.company_rider_id +"']" ).prop("selected", true);
        $('#brand_name14').val(client_data.brand_name);
        $('#rider_details123').val(riderdet);
        $('#reg_number').val(client_data.registered_number);
        $('#client_identification').val(client_data.company_clients_id);
        $('#known_clients_input').val(client_name).prop("readonly", true);
        $('#phone_num').val(fixNumber(client_data.client_primary_number)).prop("readonly", true);
        $('#source').val(client_data.source);
        $('#destination').val(client_data.destination);
        $('#delivery_charge').val(client_data.delivery_charge);
        $('#transaction_id').val(client_data.transaction_id);

        $("#payment_type option[value='" + payment_type + "']").prop("selected", true);
        $("#schedule_action_type option[value='" + schedule_action + "']").prop("selected", true);

        if (payment_type == "Cash"){
            $('#payment_mode').show();
            $("#payment_mode option[value='" + client_data.payment_mode +"']").prop("selected", true);
        } else {
            $('#payment_mode').hide();
        }

        if (schedule_action == "Scheduled Delivery"){
            $('.scheduleOption').show();
            //console.log("Schedule");
            $('#schedule_date').val(client_data.schedule_date);
            $('#schedule_time').val(client_data.schedule_time);
        }else{
            $('.scheduleOption').hide();
        }
    });

    function fixNumber(number){
        return Array.from(number).slice(1, 10).join("");
    }


    $('#manual_btn').on('click', function(){
        $('#manual_record_modal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#known_clients_input').prop("readonly", false);
        $('#phone_num').prop("readonly", false);
    });



    $('#searchDataInput').keyup(function(){
        //console.log($(this).val());
        const searchvalue = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: 'POST',
            url: "/quickquerydata",
            data: {"searchData":$(this).val()},
            success: function(data){
                const client_name = data.client_first_name + " " + data.client_last_name;
                const c_date = new Date(data.created_at);

                $('.resultprompt').text("Found results for " + client_name).css({ color: "black" });
                $('.resultdivision').slideDown(1000);

                const rider_name = data.first_name + " " + data.last_name;
                $('#resulttablebody').html("");
                const tableBody = `<tr>
                                        <td>${data.transaction_number} </td>
                                        <td> ${client_name} </td>
                                        <td> ${data.client_primary_number} </td>
                                        <td> ${data.source} </td>
                                        <td> ${data.destination} </td>
                                        <td> ${c_date.toDateString()} </td>
                                        <td> ${rider_name} </td>
                                    </tr>`;
                $('#resulttablebody').append(tableBody);
            },
            error: function(error){
                //console.log(searchvalue);
                if (searchvalue == ""){
                    $('.resultprompt').text("Waiting to search...").css({ color: "black" });
                }else{
                    $('.resultprompt').text("Searching...").css({color:"red"});
                }
                $('.resultdivision').slideUp(1000);
            }
        });
    });



    $(document).keydown((key) => {
        // console.log(key.which);
        switch(parseInt(key.which, 10)){
            case 18:
                $('#searchDataClient').modal('show');
        }
    });


});





