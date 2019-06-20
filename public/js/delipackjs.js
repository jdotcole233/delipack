$(document).ready(function(e){


    $('#initialregisterbtn').on('click', ()=> {$('.rideregistrationforms').modal('show')});


    $('#ridersubmitbtn').on('click', (event) => {
       let formvalid =  validateForms('needs-validation', event);
        if (formvalid == true){ 
            // let ridersinfomation = $('.needs-validation').serialize();
            // console.log(ridersinfomation);
            $('.rideregistrationforms').modal('hide');
            // $('#modalloader').modal('show');
            let isrequestback = postInformation($('.needs-validation').serialize(), 
            '#modalloader', 
            '',
            '',
            '/registerrider');

        } else {
            nowuiDashboards.showNotification('top', 'right', 'primary','Fill out all mandatory fields');
            // console.log("Something went wrong");
        }
    });

    $('.registerridebtn').on('click', function(e){
        let formvalidate = validateForms('ridesformsval', e);
        if (formvalidate == true){
            $('.bd-rideform-modal-lg').modal('hide');
            postInformation($('.ridesformsval').serialize(), '','.bd-rideform-modal-lg','' , '/registerride');
        } else {
            nowuiDashboards.showNotification('top','right', 'primary', 'Fill out all mandatory fields');
        }
    });

    $('.assignridebtn').on('click', function (e) {
        let assignform = validateForms('assignform', e);
        if (assignform == true) {
            postInformation($('.assignform').serialize(), '', '', '', '/assignedmotrorbiketorider');
            $('.bd-assignride-modal-sm').modal('hide');
            $('.assignform').trigger('reset');
            // $('').text('Unassign');
            // location.reload();
        } 
    });
 





    function postInformation(inputforms,loader, mainform = null,optionalmodal = null ,url){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // $(loader).modal('show');
        // $('#modalloader').modal('hide');

        $.ajax({
            method: 'POST',
            url: url,
            data: inputforms,
            success: function(data){

                // $(loader).modal('hide');
                // console.log('after modal hide');
                if (optionalmodal != null) {
                    $(optionalmodal).modal('show');
                }
                nowuiDashboards.showNotification('top', 'right', 'success',  data);

            }, 
            error: function (error){
                $(loader).modal('hide');
                $(mainform).modal('show');
                nowuiDashboards.showNotification('top', 'right', 'danger', error);

            }
        });
    }

    let riderinfo = $('#ridersoutputtable').DataTable({
        'ajax' : '/getridersinformation',
         'deferRender': true
    });

    let riderfound_id = "";

    $('#ridersoutputtable').on('click','.singleriderbtn', function(){
        riderfound_id = $(this).data('riderid');
        // console.log(riderfound_id);
        // location.href = /aboutriders/ + riderfound_id;
    });

    (function(){
        // console.log(location.pathname.substring(1,12));
        if (location.pathname.substring(1, 12) == "aboutriders"){
            riderfound_id = location.pathname.substring(13);
        }
        console.log(riderfound_id);

    })();

    if(riderfound_id != ""){
        let singleriderinfo = $('#riderstable').DataTable({
            'ajax': '/getsingleriderinformation/' + riderfound_id,
            'deferRender': false,
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
            url: '/queryCompanyTransactionData/',
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
                $('#totalsale').text(parseInt(data[1]) + parseInt(data[2]));
            },
        });
    
    });

    

    $('#transactionstable').on('click','.quickviewButton',function(){
        let dataitemobj = $(this).data('transactions');
        $('#transaction_title').text("From: " + dataitemobj.source + " To: " + dataitemobj.destination);
        $('#transaction_number').text("00" + dataitemobj.transaction_id);
        $('#created_at').text(dataitemobj.paidon);
        $('#brand_name').text(dataitemobj.brand_name);
        $('#rating').text(dataitemobj.rate_value);
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

      setInterval(function(){
        riderinfo.ajax.reload(null, false);
        ridesinfo.ajax.reload(null, false);
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
            postInformation($('.editridersinformation').serialize(), '', '', '','/editridersprofile');
            $('.editridersinformation').trigger('reset');
            $('.bd-riderprofile-modal-lg').modal('hide');
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
                        'Deleted!',
                        'Your file has been deleted.',
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


    //send editted information
    $('.editridebtn').on('click', function(e){
        let isvalidated = validateForms('editrideform',e);
        if (isvalidated == true){
            postInformation($('.editrideform').serialize(), '', '', '', '/editrideinformation')
            $('.editrideform').trigger('reset');
            $('.bd-rideeditform-modal-lg').modal('hide');
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
        let validation = Array.prototype.filter.call(forms, function (form) {
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
                    nowuiDashboards.showNotification('top', 'right', 'warning', data);
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
                    nowuiDashboards.showNotification('top', 'right', 'warning', data);
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
                console.log(data);
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

    setInterval(checkRiderStatus, 1000);







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
                    nowuiDashboards.showNotification('top', 'right', 'danger', "Passwords must match");
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
                            nowuiDashboards.showNotification('top', 'right', 'success', data);
                            $('#changePasswordFrom').trigger('reset')
                            $('#change_password_modal').modal("hide");
                            setTimeout(function(){
                                $('#logout-form').submit();
                            },2000);
                        },
                        error:function(error){
                            nowuiDashboards.showNotification('top', 'right', 'danger', "Whoops couldn't chnage your password");
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

});




