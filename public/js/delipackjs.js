$(document).ready(function(e){
 
    // let ridersImage, reader, actimage;

    // $('#profile_picture_get').change(function (e) {
    //     let getimage = e.target.files[0].name;
    //     ridersImage = e.target.files[0];
    //     console.table(ridersImage);
    //     if (window.FileReader){
    //         reader = new FileReader();
    //         reader.readAsDataURL(ridersImage);
    //         reader.onloadend = function(e){
    //             console.log(e.target.result);
    //             actimage = e.target.result;
    //             // $('#displayprofilepic').src = e.target.result;
    //         };
            
    //     }
    // });


    $('#initialregisterbtn').on('click', ()=> {$('.rideregistrationforms').modal('show')});

    // $('#riderimageupload').on('click', (e) =>{


    //     let formData = new FormData(this);
    //     //  = new FormData();
    //     // let photofile = $('#profile_picture_get')[0].files[0];
    //     formData.append("file", actimage);


    //     postInformation(formData, 
    //         '#modalloader',
    //          '.rideregistrationforms',
    //         '.bd-pictureupload-modal-lg',
    //         '/uploadriderphoto');
    //     // $('#imageuploadform').submit();
    // });

    $('#ridersubmitbtn').on('click', (event) => {
       let formvalid =  validateForms('needs-validation', event);
        if (formvalid == true){ 
            // let ridersinfomation = $('.needs-validation').serialize();
            // console.log(ridersinfomation);
            $('.rideregistrationforms').modal('hide');
            // $('#modalloader').modal('show');
            let isrequestback = postInformation($('.needs-validation').serialize(), 
            '#modalloader', 
            '.rideregistrationforms',
            '.bd-pictureupload-modal-lg',
            '/registerrider');
            // if (isrequestback == true){
            //     $('.bd-pictureupload-modal-lg').modal('show');
            // } else {
            //     $('.bd-example-modal-lg').modal('show');
            // }

        } else {
            nowuiDashboards.showNotification('top', 'right', 'primary','Fill out all mandatory fields');
            console.log("Something went wrong");
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

 $('#ridersoutputtable').DataTable({
        'ajax' : '/getridersinformation',
         'deferRender': true
    });

    
    $('#ridestable').DataTable({  
        'ajax': '/gerregrides',
        'deferRender': true
      });


$('.riderprofilebtn').on('click', function(e){
    $('.bd-riderprofile-modal-lg').modal('show');
    let riderid = window.location.pathname.substr(13);
    // console.log(riderid);
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
        console.log($('#editridersinformation').serialize());
    });

    $('#ridersoutputtable').on('click','.assignride', function(){
        let btntxt = $(this).text();
        if (btntxt.localeCompare("Assign")){
            $('.bd-assignride-modal-sm').modal('show');
            // console.log($(this).attr('id'));
            $('#assigncmp_rider').val($(this).attr('id'));
        } else {
            $(this).text('Unassign');
            $(this).addClass('danger');
        }
    });


    $('.assignridebtn').on('click', function(e){
        let assignform = validateForms('assignform', e);
        if (assignform == true){
            //write the code to assign a ride to a rider
        }else{

        }
        console.log("Hello");
    });

    $.ajax({
        method: 'GET',
        url: '/getridersinformation',
    }).done(function(data){
        console.table(data);
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
                console.log("Hello");
                form.classList.add('was-validated');
                isvalid = false;
            } else {
                isvalid = true;
            }
        });

       return isvalid;
    }

});