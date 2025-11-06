$(document).ready(function(){
    setTimeout(function(){
        $(".advertisement").click();
    },10);



    $(document).on("click",".advertisementSearch",function(){
            $("#advertismentList").html("");
            $('#loader').show();
            $("#viewMore").hide();

            let searchQuery =$(".searchKey").val();
            var ref_this = $(".advertisement.active");

            if(searchQuery!=""){
                if (ref_this.hasClass("active")) {
                    let preLength=Number($("#advertismentList").attr("data-sear"));
                    $.ajax({
                            url: "{{ route('candidate.advertisment') }}",
                            type: 'GET',
                            data: {
                            searchKey: searchQuery
                            },
                            success: function(response) {
                                if(response.length<=4){
                                    $("#viewMore").hide();
                                }
                                var currentLenth= Number(preLength+4);
                                $('#loader').hide();
                                let finalDev ="";
                                if(currentLenth>response.length){
                                    currentLenth=response.length;
                                }
                                for(let i=0; i<currentLenth; i++){
                                    let day=timeAgo(response[i].created_at);
                                    day=day?day:"Today"
                                    if(day!="Today"){
                                        day=day +"day ago";
                                    }
                                    finalDev+=`<div class="candidat_cust-item">
                                        <a href="#">
                                            <div class="candidat_cust-header">
                                                <div class="candidat_cust-logo">
                                                    <img src="/public/images/logo.png" alt="Company Logoss">
                                                </div>
                                                <span class="candidat_cust-time">`+day+`</span>
                                            </div>
                                            <h4 class="candidat_cust-title">`+response[i].job_title+`</h4>
                                            <p class="candidat_cust-description">
                                                `+response[i].job_description.substr(0, 350)+" ..."+`
                                            </p>
                                            <div class="candidat_cust-dates">
                                                <p>Start Date: <br><span>`+response[i].duration_of_engagement_start+`</span></p>
                                                <p>End Date: <br><span>`+response[i].duration_of_engagement_end+`</span></p>
                                            </div>
                                        </a>
                                    </div>`;
                                }
                                if(response.length>4){
                                    finalDev+=`<div class="button_flex_cust_form advertisementSearch" >
                                        <button class="hover-effect-btn border_btn ">View More</button>
                                    </div>`;
                                }
                                console.log(finalDev,"Advertisment..............");
                                $("#advertismentList").attr("data-sear", currentLenth);

                                $("#advertismentList").html(finalDev);

                            },
                            error: function(xhr, status, error) {
                                console.error("Error occurred: " + status + " " + error);
                            }

                    });
                }else{
                    let preLength=Number($("#advertismentList").attr("data-archsear"));
                    $.ajax({
                            url: "{{ route('candidate.advertismentArchive') }}",
                            type: 'GET',
                            data: {
                            searchKey: searchQuery
                            },
                            success: function(response) {
                                if(response.length<=4){
                                    $("#viewMore").hide();
                                }
                                var currentLenth= Number(preLength+4);
                                $('#loader').hide();
                                let finalDev ="";
                                if(currentLenth>response.length){
                                    currentLenth=response.length;
                                }
                                for(let i=0; i<currentLenth; i++){
                                    let day=timeAgo(response[i].created_at);
                                    day=day?day:"Today"
                                    if(day!="Today"){
                                        day=day +"day ago";
                                    }
                                    finalDev+=`<div class="candidat_cust-item">
                                        <a href="#">
                                            <div class="candidat_cust-header">
                                                <div class="candidat_cust-logo">
                                                    <img src="/public/images/logo.png" alt="Company Logos">
                                                </div>
                                                <span class="candidat_cust-time">`+day+`</span>
                                            </div>
                                            <h4 class="candidat_cust-title">`+response[i].job_title+`</h4>
                                            <p class="candidat_cust-description">
                                                `+response[i].job_description.substr(0, 350)+" ..."+`
                                            </p>
                                            <div class="candidat_cust-dates">
                                                <p>Start Date: <br><span>`+response[i].duration_of_engagement_start+`</span></p>
                                                <p>End Date: <br><span>`+response[i].duration_of_engagement_end+`</span></p>
                                            </div>
                                        </a>
                                    </div>`;
                                }
                                if(response.length>4){
                                    finalDev+=`<div class="button_flex_cust_form advertArchive" id="">
                                        <button class="hover-effect-btn border_btn ">View More</button>
                                    </div>`;
                                }
                                console.log(finalDev,"Advertisment..............");
                                $("#advertismentList").attr("data-archsear", currentLenth);

                                $("#advertismentList").html(finalDev);

                            },
                            error: function(xhr, status, error) {
                                console.error("Error occurred: " + status + " " + error);
                            }

                    });
                }
            }else{

                // var ref_that = $("#advertArchive.active");
                if (ref_this.hasClass("active")) {
                    $(".advertisement").click();
                }else {
                    $("#advertArchive").click();
                }

            }
    });


    $(document).on("click",".advertisement",function(){
        $(".searchKey").val("");
            $('#loader').show();
            let preLength=Number($("#advertismentList").attr("data-len"));


                    $.ajax({
                        url: "{{ route('candidate.advertisment') }}",
                        type: 'GET',
                        data: '',
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            var currentLenth= preLength+4;
                            $('#loader').hide();
                            let finalDev ="";
                            if(currentLenth>response.length){
                                currentLenth=response.length;
                            }
                            for(let i=0; i<currentLenth; i++){
                                    let day=timeAgo(response[i].created_at);
                                    day=day?day:"Today"
                                    if(day!="Today"){
                                        day=day +"day ago";
                                    }
                                finalDev+=`<div class="candidat_cust-item">
                                                <a href="#">
                                                    <div class="candidat_cust-header">
                                                        <div class="candidat_cust-logo">
                                                            <img src="/public/images/logo.png" alt="Company Logo">
                                                        </div>
                                                        <span class="candidat_cust-time">`+day+`</span>
                                                    </div>
                                                    <h4 class="candidat_cust-title">`+response[i].job_title+`</h4>
                                                    <p class="candidat_cust-description">
                                                        `+response[i].job_description.substr(0, 350)+" ..."+`
                                                    </p>
                                                    <div class="candidat_cust-dates">
                                                        <p>Start Date: <br><span>`+response[i].duration_of_engagement_start+`</span></p>
                                                        <p>End Date: <br><span>`+response[i].duration_of_engagement_end+`</span></p>
                                                    </div>
                                                </a>
                                            </div>`;
                            }
                            if(response.length>4){
                                finalDev+=`<div class="button_flex_cust_form" id="viewMore">
                                    <button class="hover-effect-btn border_btn ">View More</button>
                                </div>`;
                            }
                            console.log(finalDev,"Advertisment..............");
                            $("#advertismentList").attr("data-len", currentLenth);

                            $("#advertismentList").html(finalDev);

                        },
                        error: function(xhr, status, error) {
                            console.error("Error occurred: " + status + " " + error);
                        }
                    });




    });

    $(document).on("click","#viewMore",function(){
        $(".advertisement").click();
    })

    $(document).on("click",".advertArchive",function(){
        $(".searchKey").val("")
        $('#loader').show();
            let preLength=Number($("#advertismentList").attr("data-arch"));


                    $.ajax({
                        url: "{{ route('candidate.advertismentArchive') }}",
                        type: 'GET',
                        data: '',
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            var currentLenth= (response.length>4)?Number(preLength)+4:response.length;
                            $('#loader').hide();
                            let finalDev ="";
                            if(currentLenth>response.length){
                                currentLenth=response.length;
                            }
                            for(let i=0; i<currentLenth; i++){
                                    let day=timeAgo(response[i].created_at);
                                    day=day?day:"Today"
                                    if(day!="Today"){
                                        day=day +"day ago";
                                    }

                                finalDev+=`<div class="candidat_cust-item">
                                                <a href="#">
                                                    <div class="candidat_cust-header">
                                                        <div class="candidat_cust-logo">
                                                            <img src="/public/images/logo.png" alt="Company Logo">
                                                        </div>
                                                        <span class="candidat_cust-time">`+day+`</span>
                                                    </div>
                                                    <h4 class="candidat_cust-title">`+response[i].job_title+`</h4>
                                                    <p class="candidat_cust-description">
                                                        `+response[i].job_description.substr(0, 350)+`
                                                    </p>
                                                    <div class="candidat_cust-dates">
                                                        <p>Start Date: <br><span>`+response[i].duration_of_engagement_start+`</span></p>
                                                        <p>End Date: <br><span>`+response[i].duration_of_engagement_end+`</span></p>
                                                    </div>
                                                </a>
                                            </div>`;
                            }
                            if(response.length>4){
                                finalDev+=`<div class="button_flex_cust_form advertArchive" id="viewMorearch">
                                    <button class="hover-effect-btn border_btn ">View More</button>
                                </div>`;
                            }
                            if(!response.length){
                                finalDev+=`<div class="">
                                    <span>No Data Found</span>
                                </div>`;

                            }
                            console.log(finalDev,"Advertisment..............");
                            $("#advertismentList").attr("data-arch", currentLenth);

                            $("#advertismentList").html(finalDev);

                        },
                        error: function(xhr, status, error) {
                            console.error("Error occurred: " + status + " " + error);
                        }
                    });

    });

});



function timeAgo(date) {
    const now = new Date();
    const createdAt = new Date(date);
    const diffInMs = now - createdAt;
    const diffInDays = Math.floor(diffInMs / (1000 * 60 * 60 * 24));
    return diffInDays;
}
