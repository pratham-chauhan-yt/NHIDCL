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

            const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta?.getAttribute('content');

            const finalUrl = websiteUrl ? `${websiteUrl}/resource-pool-portal/candidate/advertisment` : null;
            const imageUrl = websiteUrl ? `${websiteUrl}/public/images/logo.png` : null;

            if(searchQuery!=""){
                if (ref_this.hasClass("active")) {
                    let preLength=Number($("#advertismentList").attr("data-sear"));
                    $.ajax({
                            url: finalUrl,
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
                                    let formattedStartDate = formatDate(response[i].start_date);
                                    let formattedEndDate = formatDate(response[i].end_date);
                                    finalDev+=`<div class="candidat_cust-item" onclick="toggleModal(`+response[i].id+`)" id="`+response[i].id+`">
                                        <a href="#">
                                            <div class="candidat_cust-header">
                                                <div class="candidat_cust-logo">
                                                    <img src="`+imageUrl+`" alt="Company Logo">
                                                </div>
                                                <span class="candidat_cust-time">`+day+`</span>
                                            </div>
                                            <h4 class="candidat_cust-title">`+response[i].job_title+`</h4>
                                            <p class="candidat_cust-description">
                                                `+response[i].job_description.substr(0, 350)+" ..."+`
                                            </p>
                                            <div class="candidat_cust-dates">
                                                <p>Start Date: <br><span>`+formattedStartDate+`</span></p>
                                                <p>End Date: <br><span>`+formattedEndDate+`</span></p>
                                            </div>
                                        </a>
                                    </div>`;
                                }
                                if(response.length>4){
                                    finalDev+=`<div class="button_flex_cust_form advertisementSearch" >
                                        <button class="hover-effect-btn border_btn ">View More</button>
                                    </div>`;
                                }
                                if(!response.length){
                                    finalDev+=`<div class="">
                                        <span>No Data Found</span>
                                    </div>`;

                                }
                                // console.log(finalDev,"Advertisment..............");
                                $("#advertismentList").attr("data-sear", currentLenth);

                                $("#advertismentList").html(finalDev);

                            },
                            error: function(xhr, status, error) {
                                console.error("Error occurred: " + status + " " + error);
                            }

                    });
                }else{
                    let preLength=Number($("#advertismentList").attr("data-archsear"));

                    const websiteMeta = document.querySelector('meta[name="website-url"]');
                    const websiteUrl = websiteMeta?.getAttribute('content');
                    const finalUrl = websiteUrl ? `${websiteUrl}/resource-pool-portal/candidate/advertismentArchive` : null;
                    const imageUrl = websiteUrl ? `${websiteUrl}/public/images/logo.png` : null;

                    $.ajax({
                            url: finalUrl,
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
                                    let formattedStartDate = formatDate(response[i].start_date);
                                    let formattedEndDate = formatDate(response[i].end_date);
                                    finalDev+=`<div class="candidat_cust-item" onclick="toggleModal(`+response[i].id+`)" id="`+response[i].id+`">
                                        <a href="#">
                                            <div class="candidat_cust-header">
                                                <div class="candidat_cust-logo">
                                                    <img src="`+imageUrl+`" alt="Company Logo">
                                                </div>
                                                <span class="candidat_cust-time">`+day+`</span>
                                            </div>
                                            <h4 class="candidat_cust-title">`+response[i].job_title+`</h4>
                                            <p class="candidat_cust-description">
                                                `+response[i].job_description.substr(0, 350)+" ..."+`
                                            </p>
                                            <div class="candidat_cust-dates">
                                                <p>Start Date: <br><span>`+formattedStartDate+`</span></p>
                                                <p>End Date: <br><span>`+formattedEndDate+`</span></p>
                                            </div>
                                        </a>
                                    </div>`;
                                }
                                if(response.length>4){
                                    finalDev+=`<div class="button_flex_cust_form advertArchive" id="">
                                        <button class="hover-effect-btn border_btn ">View More</button>
                                    </div>`;
                                }
                                if(!response.length){
                                    finalDev+=`<div class="">
                                        <span>No Data Found</span>
                                    </div>`;

                                }
                                // console.log(finalDev,"Advertisment..............");
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

       if(this.id=="defaultOpen"){
        $("#advertismentList").attr("data-len", 0);
       }
        $(".searchKey").val("");
            $('#loader').show();
            let preLength=Number($("#advertismentList").attr("data-len"));

            const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta?.getAttribute('content');
            const finalUrl = websiteUrl ? `${websiteUrl}/resource-pool-portal/candidate/advertisment` : null;
            const imageUrl = websiteUrl ? `${websiteUrl}/public/images/logo.png` : null;

                    $.ajax({
                        url: finalUrl,
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
                                let description="";
                                if (response[i].job_description) {
                                    description = response[i].job_description.substr(0, 350) + " ...";
                                } else {
                                    description = "No description available.";
                                }
                                let formattedStartDate = formatDate(response[i].start_date);
                                let formattedEndDate = formatDate(response[i].end_date);
                                finalDev+=`<div class="candidat_cust-item" onclick="toggleModal(`+response[i].id+`)" id="`+response[i].id+`">
                                                <a href="#">
                                                    <div class="candidat_cust-header">
                                                        <div class="candidat_cust-logo">
                                                            <img src="`+imageUrl+`" alt="Company Logo">
                                                        </div>
                                                        <span class="candidat_cust-time">`+day+`</span>
                                                    </div>
                                                    <h4 class="candidat_cust-title">`+response[i].job_title+`</h4>
                                                    <p class="candidat_cust-description">
                                                        `+description+`
                                                    </p>
                                                    <div class="candidat_cust-dates">
                                                        <p>Start Date: <br><span>`+formattedStartDate+`</span></p>
                                                        <p>End Date: <br><span>`+formattedEndDate+`</span></p>
                                                    </div>
                                                </a>
                                            </div>`;
                            }
                            if(response.length>4){
                                finalDev+=`<div class="button_flex_cust_form" id="viewMore">
                                    <button class="hover-effect-btn border_btn ">View More</button>
                                </div>`;
                            }
                            if(!response.length){
                                finalDev+=`<div class="">
                                    <span>No Data Found</span>
                                </div>`;

                            }
                            // console.log(finalDev,"Advertisment..............");
                            $("#advertismentList").attr("data-len", currentLenth);

                            $("#advertismentList").html(finalDev);

                        },
                        error: function(xhr, status, error) {
                            console.error("Error occurred: " + status + " " + error);
                        }
                    });




    });

    $(document).on("click","#viewMore",function(){
        $(".advertisement").attr("id", 1);
        $(".advertisement").click();
        $(".advertisement").attr("id", "defaultOpen");
    })

    $(document).on("click",".advertArchive",function(){
        if(this.id=="advertArchive"){
            $("#advertismentList").attr("data-arch", 0);
        }
        $(".searchKey").val("")
        $('#loader').show();
            let preLength=Number($("#advertismentList").attr("data-arch"));

            const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta?.getAttribute('content');
            const finalUrl = websiteUrl ? `${websiteUrl}/resource-pool-portal/candidate/advertismentArchive` : null;
            const imageUrl = websiteUrl ? `${websiteUrl}/public/images/logo.png` : null;
                    $.ajax({
                        url: finalUrl,
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
                                let formattedStartDate = formatDate(response[i].start_date);
                                let formattedEndDate = formatDate(response[i].end_date);

                                finalDev+=`<div class="candidat_cust-item" onclick="toggleModal(`+response[i].id+`)" id="`+response[i].id+`">
                                                <a href="#">
                                                    <div class="candidat_cust-header">
                                                        <div class="candidat_cust-logo">
                                                            <img src="`+imageUrl+`" alt="Company Logo">
                                                        </div>
                                                        <span class="candidat_cust-time">`+day+`</span>
                                                    </div>
                                                    <h4 class="candidat_cust-title">`+response[i].job_title+`</h4>
                                                    <p class="candidat_cust-description">
                                                        `+response[i].job_description.substr(0, 350)+`
                                                    </p>
                                                    <div class="candidat_cust-dates">
                                                        <p>Start Date: <br><span>`+formattedStartDate+`</span></p>
                                                        <p>End Date: <br><span>`+formattedEndDate+`</span></p>
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
                            // console.log(finalDev,"Advertisment..............");
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

function toggleModal(id) {
    const modal = document.getElementById('popup-modal');
    modal.classList.toggle('show');
    let year="years";

    const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta?.getAttribute('content');
            const finalUrl = websiteUrl ? `${websiteUrl}/resource-pool-portal/candidate/archiveDetails` : null;

    $.ajax({
        url: finalUrl,
        type: 'GET',
        data: { add_id: id },
        success: function(response) {
            $("#duration_of_engagement_end").text(response.end_date ?? "");
            $("#number_of_required_resources").text(response.number_of_required_resources || "");
            let yearText = (response.engagement_year || "0") + " Year ";
            let monthText = (response.engagement_month || "0") + " Month";
            $("#duration_of_engagement").text(yearText + monthText);

            $("#job_description").text(response.job_description ?? "");
            $("#job_title").text(response.job_title ?? "");

            let year = response.work_exp?.fetch_year || 0;
            $("#minimum_work_experience").text(year);
            let view_efile = window.location.href.substring(0, window.location.href.indexOf('editPostedJobs')) + "viewFiles?pathName=" + response.upload_for_efile_noting_filepath + "&fileName=" + response.upload_for_efile_noting;
            $("#view_advertisment_details").html(`<a target="_blank" href="`+view_efile+`"><i class="fa fa-eye"></i></a>`);
        },
        error: function(xhr, status, error) {
            console.error("Error occurred: " + status + " " + error);
        }
    });
}

function formatDate(dateString) {
    const date = new Date(dateString);
    const pad = (n) => n.toString().padStart(2, '0');

    const day = pad(date.getDate());
    const month = pad(date.getMonth() + 1); // months are 0-based
    const year = date.getFullYear();
    const hours = pad(date.getHours());
    const minutes = pad(date.getMinutes());
    const seconds = pad(date.getSeconds());

    return `${day}-${month}-${year} ${hours}:${minutes}:${seconds}`;
}
