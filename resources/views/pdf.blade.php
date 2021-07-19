<?php use Carbon\Carbon;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
</head>
<style type="text/css">
    @font-face {
        font-family: "NotoSans";
        src: url({{ storage_path("fonts\NotoSans-Regular.ttf") }}) format("truetype");
        font-weight: 400;
        font-style: normal; 
    }
    @font-face {
        font-family: "NotoSans";
        src: url({{ storage_path("fonts\NotoSans-Bold.ttf") }}) format("truetype");
        font-weight: 700;
        font-style: normal; 
    }
    body {
        font-family: "NotoSans";
        font-weight: 400;  
    }
    .container{
        margin: 0 auto;  
        width: 100%;
    }    
    p {
        margin: 0;   
        font-size: 12pt;
    }
    .float-left{
        float: left;
    }
    .float-right{
        float: right;
    }
    .d-inline{
        display: inline;
    }
</style>
<body>
    <div class="container">
    <div class="float-left d-inline">
    <div style="width:390px; padding-right:10px;">
            <h2 style="background-color:#FFD523; padding:5px 10px; margin:0 0 20px 0; line-height:20px; color:#2C2E43; border-radius:3px;">{{$entry->name}}</h2>
            <p><b> NID/Passport No. : </b>{{$entry->nid}}</p>
            <p><b> Contact No :   </b>{{$entry->contact_no}}</p>
            <p><b> Alternative Contact No : </b>{{$entry->alternative_contact_no}}</p>
            <p><b> Mailing Address : </b>{{$entry->mailing_address}}.</p>
            <p><b> Email : </b>{{$entry->email_address}}</p>
            <p><b> Date of Birth : </b>{{Carbon::parse($entry->date_of_birth)->toFormattedDateString()}}</p>
            <p><b> Marital Status : </b>{{$entry->marital_status}}</p>
            <p><b> Marriage Anniversary : </b>{{$entry->marriage_anniversary}}</p>
            <p><b> Spouse Name : </b>{{$entry->spouse_name}}</p>
            <p><b> Children : </b>{{$entry->no_of_children}}</p>
            <p><b> Educational Qualification : </b>{{$entry->educational_qualification}}</p>
            <p><b> Professional Status : </b>{{$entry->professional_status}}</p>
            <p><b> Religion : </b>{{$entry->religion}}</p>
            <p><b> Blood Group : </b>{{$entry->blood_group}}</p>
        </div>
    </div>
        
        <div class="float-right d-inline">
            <img src="{{storage_path('/app/public/images/'.$entry->photo)}}" alt="{{$entry->photo}}" style="width: 300px;">
        </div>
    </div>
</body>
</html>