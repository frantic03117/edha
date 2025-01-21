<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
        }

        .header {
            text-align: center;
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            border-radius: 5px 5px 0 0;
        }

        .content {
            margin: 20px 0;
        }

        .content h3 {
            margin-top: 0;
        }

        .info-item {
            margin-bottom: 10px;
        }

        .info-item strong {
            display: inline-block;
            width: 180px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>New Service Request</h1>
        </div>
        <div class="content">
            <h3>Client Information</h3>
            <div class="info-item">
                <strong>Name:</strong> {{  $mailData['body']['name']  }}
            </div>
            <div class="info-item">
                @php
                     $items =  json_decode($mailData['body']?->search_data?->sub_cats);
                @endphp
                <strong>Service:</strong> @foreach($items as $itm)
                <span>{{$itm->sub_category}} </span>
                @endforeach
            </div>
            <div class="info-item">
                <strong>Location:</strong>  {{$mailData['body']?->search_data?->city_name?->city }},{{$mailData['body']?->search_data?->state_name?->state }}
            </div>
            <div class="info-item">
                <strong>Credit Points to Connect:</strong> {{$mailData['charges']}}
            </div>
           
            <div class="info-item">
                <strong>Mobile:</strong> +91*******
            </div>
            <div class="info-item">
                <strong>E-Mail:</strong> **y***@***.com
            </div>
            <h3>Detailed Requirement</h3>
            <div class="info-item">
                <strong>What can we assist you with?</strong> {{$mailData['body']?->search_data?->category_name?->category }}
            </div>
            <div class="info-item">
                <strong>You need Consultation for Self or Someone else?</strong> {{ $mailData['body']?->search_data?->for_me == "1" ? 'Yes, for me' : 'No, for someone else' }}
            </div>
            @if($mailData['body']?->search_data?->for_me == "0" )
            <div class="info-item">
                <strong>For whom do you wish to seek this service?</strong> {{ $mailData['body']?->search_data?->for_whom }}
            </div>
            @endif
            <div class="info-item">
                <strong>What is the age of the person requiring service?</strong> {{ $mailData['body']?->search_data?->age_group }}
            </div>
           
        
            <div class="info-item">
                <strong>Which region are you from?</strong> {{$mailData['body']?->search_data?->city_name?->city }},{{$mailData['body']?->search_data?->state_name?->state }}
            </div>
            <div class="info-item">
                <strong>Would you consider online Consultation?</strong> {{ $mailData['body']?->search_data?->contact_mode }}
            </div>
            <div class="info-item">
                <strong>How soon would you like the service?</strong> {{ $mailData['body']?->search_data?->how_soon }}
            </div>
            <div class="info-item">
                <strong>Any preference of language for your service?</strong> {{ $mailData['body']?->search_data?->languages }}
            </div>
        </div>
        <div class="footer">
            <p>This is an automated email. Please do not reply directly.</p>
        </div>
    </div>
</body>

</html>