$(document).ready(function(){
    // window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
    // var validation = Array.prototype.filter.call(forms, function (form) {

    $('#ridersubmitbtn').on('click', (event) => {
       let formvalid =  validateForms('needs-validation', event);
        if (formvalid == true){ 
            console.log("everything good");
        } else {
            console.log("Something went wrong");
        }
    });








    
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