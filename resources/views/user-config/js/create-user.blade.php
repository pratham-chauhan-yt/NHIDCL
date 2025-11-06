<script>
    $(document).ready(function(){
        /*************Code to show date of birth 18 years ago ***************** */

            var today = new Date();
            var eighteenYearsAgo = new Date(today.setFullYear(today.getFullYear() - 18));
            var dd = String(eighteenYearsAgo.getDate()).padStart(2, '0');
            var mm = String(eighteenYearsAgo.getMonth() + 1).padStart(2, '0'); // Months are 0-based
            var yyyy = eighteenYearsAgo.getFullYear();

            var formattedDate = yyyy + '-' + mm + '-' + dd;

            $('#date_of_birth').attr('max', formattedDate);

        /********************End 18 years ago code **************** */
        
        $(document).on("click","#creteUserButton",function(){
            let   $full_name= $("#full_name").val();
            let   $email= $("#email").val();
            let   $mobile_no= $("#mobile_no").val();
            let   $status= $("#status").val();
            let   $date_of_birth= $("#date_of_birth").val();
            let   $ref_designation_id=$("#ref_designation_id").val();
            let   $ref_department_id= $("#ref_department_id").val();
            let   $address= $("#address").val();
            let   $ref_office_type_id= $("#ref_office_type_id").val();
            let   $date_of_joining= $("#date_of_joining").val();
            let   $currently_posted= $("#currently_posted").val();
           
           $("#full_name_err").text("");
           $("#email_err").text("");
           $("#mobile_no_err").text("");
           $("#status_err").text("");
           $("#date_of_birth_err").text("");
           $("#ref_designation_id_err").text("");
           $("#ref_department_id_err").text("");
           $("#address_err").text("");
           $("#ref_office_type_id_err").text("");
           $("#date_of_joining_err").text("");
           $("#currently_posted_err").text("");
            
           let $err =0;
           if($full_name==""){
             $("#full_name_err").text("Full name field is required"); 
                $err=1;
            }else{
                if(($full_name.length>50) || ($full_name.length<2) ){
                    $("#full_name_err").text("Full name should be of 2 to 50 characters");
                        $err=1;
                }
           }
    
           if($email==""){
             $("#email_err").text("Email field is required");
                $err=1;
            }
           else{
                if(isEmail($email)==false){
                    $("#email_err").text("Invalid email!");
                        $err=1;
                }
           }
           if($status==""){
             $("#status_err").text("Status field is required");
                $err=1;
           }
           if($mobile_no==""){
             $("#mobile_no_err").text("Mobile number field is required");
                $err=1;
            }else{
                if(isNaN($mobile_no)){
                    $("#mobile_no_err").text("Mobile number should be only numbers");
                        $err=1;
                }else{
                    if(($mobile_no.length>15) || ($mobile_no.length<7)){
                        $("#mobile_no_err").text("Mobile number should be of 7 to 15 digits");
                            $err=1;
                    }
                }
           }
           
           if($date_of_birth==""){
             $("#date_of_birth_err").text("Date of birth field is required");
                $err=1;
           }
           
           if($ref_designation_id==""){
             $("#ref_designation_id_err").text("Designation field is required");
                $err=1;
            }
            if($ref_department_id==""){
             $("#ref_department_id_err").text("Department field is required");
                $err=1;
            }
           if($address==""){
             $("#address_err").text("Address field is required");
                $err=1;
            }
           if($ref_office_type_id==""){
             $("#ref_office_type_id_err").text("Office type field is required");
                $err=1;
            }
           if($date_of_joining==""){
             $("#date_of_joining_err").text("Date of joining field is required");
                $err=1;
            }
           if($currently_posted==""){
             $("#currently_posted_err").text("Currently posted field is required");
                $err=1;
            }
           if($err){
            $("#defaultOpen").focus();
            return false;
           }else{
            $("#createUserFrm").submit();
           }
        });
    });
</script>