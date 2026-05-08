<!DOCTYPE html>
<html>
<head>
    <title>Profile Dashboard</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- DataTable CSS -->
    <link rel="stylesheet"
          href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, sans-serif;
        }

        body{
            background:linear-gradient(135deg,#f8fbff,#eef4ff);
            min-height:100vh;
            padding:35px;
        }

        .container{
            width:100%;
            max-width:1400px;
            margin:auto;
        }

        /* Header */

        .header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:30px;
            flex-wrap:wrap;
            gap:15px;
        }

        h2{
            color:#1e293b;
            font-size:38px;
            font-weight:bold;
        }

        .top-btn{
            background:linear-gradient(135deg,#6366f1,#3b82f6);
            color:white;
            padding:14px 24px;
            text-decoration:none;
            border-radius:12px;
            font-weight:bold;
            transition:0.3s;
            box-shadow:0 5px 15px rgba(59,130,246,0.2);
        }

        .top-btn:hover{
            transform:translateY(-3px);
        }

        /* Success Message */

        .success{
            background:#dcfce7;
            color:#166534;
            padding:16px;
            border-radius:12px;
            margin-bottom:20px;
            border-left:5px solid #22c55e;
            font-weight:bold;
        }

        /* Table */

        .table-box{
            background:white;
            padding:20px;
            border-radius:20px;
            box-shadow:0 10px 30px rgba(0,0,0,0.08);
            overflow-x:auto;
        }

        table{
            width:100% !important;
            border-collapse:collapse;
        }

        table th{
            background:#eef2ff;
            color:#3730a3;
            padding:18px !important;
            text-transform:uppercase;
            font-size:14px;
        }

        table td{
            padding:18px !important;
            text-align:center;
            border-bottom:1px solid #f1f5f9;
            color:#475569;
            vertical-align:middle;
        }

        table tr:hover{
            background:#f8fafc;
        }

        /* Profile Image */

        img{
            width:70px;
            height:70px;
            border-radius:50%;
            object-fit:cover;
            border:4px solid #dbeafe;
            transition:0.3s;
        }

        img:hover{
            transform:scale(1.08);
        }

        /* Badge */

        .badge{
            background:#e0e7ff;
            color:#4338ca;
            padding:7px 14px;
            border-radius:30px;
            font-size:13px;
            font-weight:bold;
        }

        /* Buttons */

        .action-box{
            display:flex;
            justify-content:center;
            gap:10px;
            flex-wrap:wrap;
        }

        .view-btn,
        .edit-btn,
        .delete-btn{
            padding:10px 16px;
            border-radius:10px;
            text-decoration:none;
            color:white;
            font-size:14px;
            font-weight:bold;
            transition:0.3s;
            border:none;
            cursor:pointer;
        }

        .view-btn{
            background:#22c55e;
        }

        .view-btn:hover{
            background:#16a34a;
            transform:translateY(-2px);
        }

        .edit-btn{
            background:#0ea5e9;
        }

        .edit-btn:hover{
            background:#0284c7;
            transform:translateY(-2px);
        }

        .delete-btn{
            background:#ef4444;
        }

        .delete-btn:hover{
            background:#dc2626;
            transform:translateY(-2px);
        }

        /* Description */

        .desc{
            max-width:250px;
            margin:auto;
            line-height:1.5;
        }

        /* DataTable */

        .dataTables_wrapper .dataTables_filter input{
            border:1px solid #cbd5e1;
            border-radius:8px;
            padding:8px;
            margin-left:8px;
        }

        .dataTables_wrapper .dataTables_length select{
            border:1px solid #cbd5e1;
            border-radius:8px;
            padding:5px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button{
            border-radius:8px !important;
            margin:3px;
        }

        /* Responsive */

        @media(max-width:768px){

            body{
                padding:20px;
            }

            h2{
                font-size:28px;
            }

            .header{
                flex-direction:column;
                align-items:flex-start;
            }

        }

    </style>

</head>
<body>

<div class="container">

    <!-- Header -->

    <div class="header">

        <h2>👤 Profile Dashboard</h2>

        <a href="{{ route('profiles.create') }}"
           class="top-btn">

           + Add New Profile

        </a>

    </div>

    <!-- Success Message -->

    @if(session('success'))

        <div class="success">

            {{ session('success') }}

        </div>

    @endif

    <!-- Table -->

    <div class="table-box">

        <table id="profileTable">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>

                </tr>

            </thead>

            <tbody>

                @foreach($profiles as $profile)

                <tr>

                    <!-- ID -->

                    <td>

                        #{{ $profile->id }}

                    </td>

                    <!-- Image -->

                    <td>

                        <img src="{{ asset('profile_images/'.$profile->image) }}">

                    </td>

                    <!-- Name -->

                    <td>

                        <strong>{{ $profile->name }}</strong>

                    </td>

                    <!-- Email -->

                    <td>

                        {{ $profile->email }}

                    </td>

                    <!-- Description -->

                    <td>

                        <div class="desc">

                            {{ $profile->description }}

                        </div>

                    </td>

                    <!-- Status -->

                    <td>

                        <span class="badge">

                            Active

                        </span>

                    </td>

                    <!-- Actions -->

                    <td>

                        <div class="action-box">

                            <!-- View -->

                            <a href="{{ route('profiles.show',$profile->id) }}"
                               class="view-btn">

                               👁 

                            </a>

                            <!-- Edit -->

                            <a href="{{ route('profiles.edit',$profile->id) }}"
                               class="edit-btn">

                               ✏ 

                            </a>

                            <!-- Delete -->

                            <form action="{{ route('profiles.destroy',$profile->id) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button class="delete-btn"
                                        onclick="return confirm('Are you sure to delete this profile?')">

                                    🗑 

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

<!-- jQuery -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTable JS -->

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>

    $(document).ready(function () {

        $('#profileTable').DataTable({

            responsive:true,

            pageLength:5,

            lengthMenu:[5,10,25,50],

            language:{

                search:" Search:",

                lengthMenu:"Show _MENU_ Profiles",

                info:"Showing _START_ to _END_ of _TOTAL_ Profiles",

                paginate:{

                    previous:"←",

                    next:"→"

                }

            }

        });

    });

</script>

</body>
</html>