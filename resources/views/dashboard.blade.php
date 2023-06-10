<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TO-DO</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <style>
        body {
            height: 100vh;
            background-repeat: no-repeat;
            overflow-x: hidden;
        }

        tr:first-child {
            border-top-left-radius: 14px;
            border-bottom-left-radius: 14px;
        }

        #contextMenu {
            position: absolute;
            display: none;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            padding: 0 4px;
        }

        .column {
            flex: 50%;
            padding: 0 4px;
        }

        .column img {
            margin-top: 8px;
            vertical-align: middle;
        }

        #bg {
            background-image: url("{{ $appearance }}");
            background-size: cover;

        }

        th {
            font-size: larger;
        }

        .table {

            border-radius: 10px;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        .d1:hover {
            background: #fff;
        }

        #d2 {
            display: block;
            position: static;
            margin-bottom: 5px;
            overflow: hidden;
            padding: 0;
            border-radius: 8px;
            border: none;
            box-shadow: 6px 4px 20px #cdcdcd;
            background: #ffffff80;
            backdrop-filter: blur(15px);
        }

        .d1 {
            text-decoration: none;
            color: #5d5a5a;
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 15px;
        }

        tr {
            background-color: #ffffff82;
            backdrop-filter: blur(8px)
        }

        .select_theme {
            cursor: pointer;
        }
    </style>

</head>

<body id="bg">
    <div class="row h-100">
        <div style=" padding-right: 0px; padding-left: 0px; background-color: #ffffff36; backdrop-filter: blur(3px);"
            class="col-2 position-relative">
            <div class="d-grid">
                <div class="list-group">
                    <a href="{{ route('dashboard') }}"
                        class="my-menu list-group-item list-group-item-action {{ $id == 0 ? 'active' : '' }}"
                        aria-current="true">
                        Default list
                    </a>
                    @foreach ($lists as $list)
                        <a data-id="{{ $list->id }}" href="{{ route('dashboard', $list->id) }}"
                            id="list{{ $list->id }}"
                            class="my-menu list-group-item list-group-item-action  {{ $id == $list->id ? 'active' : '' }}">{{ $list->name }}</a>
                        <form action="{{ route('list.update', $list->id) }}" method="post">
                            @csrf
                            <div class="input-group mb-0">

                                <input style="display: none;" value="{{ $list->name }}" name="name"
                                    id="list1{{ $list->id }}" type="text" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </form>
                    @endforeach

                </div>
                <form action="/list/create" method="post">
                    @csrf
                    <div class="input-group mb-3">

                        <input style="display: none;" name="name" id="list_xy" type="text" class="form-control"
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                </form>

                <button style="width: 100%;" class="btn btn-light position-absolute bottom-0 start-0" id="btnn">
                    +New list </button>
            </div>
        </div>

        <div style="height: 100%;padding-right: calc(var(--bs-gutter-x) * 1);" class="col-10">


            <h1 style="text-align: left; color:#00476f; margin-top:35px; margin-bottom:35px"> To-do List</h1>

            <button
                style="background-color:#ffffff82; padding:11px 25px; float: right; font-size: 20px; margin-right: 128px; margin-bottom: 15px; margin-top:-85px; border-radius:10px; border:none;"
                data-bs-toggle="modal" data-bs-target="#exampleModal">+ New</button>
            @if ($id > 0)
                <button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                    style="background-color:#ffffff82; padding:11px 25px; float: right; font-size: 20px; margin-right: 1px; margin-bottom: 15px; margin-top:-85px; border-radius:10px; border:none;"
                    aria-controls="offcanvasExample">
                    Theme
                </button>
            @endif

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add your Task</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('task.create') }}" method="post" id="form">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <input type="hidden" name="talent" value="{{ $id }}">
                                    <label for="exampleFormControlInput1" class="form-label">Task</label>
                                    <input name="task" type="text" class="form-control"
                                        id="exampleFormControlInput1" placeholder="Enter the task">
                                </div>

                                <label for="exampleFormControl" class="form-label">Select your priority of task</label>
                                <select name="priority" class="form-select" aria-label="Default select example"
                                    required>

                                    <option selected value=""> Select</option>
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="hide" class="btn btn-primary">Add</button>
                                <button id="loading" style="display:none;" class="btn btn-primary" id="show"
                                    type="button" disabled>
                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                    Loading...
                                </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <table class="table" style="vertical-align: middle; border-spacing: 0 15px;border-collapse: separate;">

                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td style="width:50px;border-top-left-radius: 14px;border-bottom-left-radius: 14px">
                                <span style="cursor:pointer">
                                    <a href="{{ route('task.complete', $task->id) }}">
                                        <!-- <i class="fa-light fa-circle-check" style="font-size:30px;color:#0872d4"> </i> -->

                                        <svg style="height: 27px;" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </a>
                                </span>
                            </td>
                            <td>{{ $task->task }}</td>

                            <td>{{ $task->priority }}</td>
                            <td style=" width: 150px;border-top-right-radius: 14px;border-bottom-right-radius: 14px;">
                                <span style="cursor:pointer"><i class="fas fa-pen"
                                        style="font-size:17px;color:#0c0c0c; margin-left:15px; margin-right:15px;"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal{{ $task->id }}"></i>
                                </span>
                                <span style="cursor:pointer"> <i class="fa fa-trash-o"
                                        style="font-size:20px;color:#890d0d" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal11{{ $task->id }}"></i>
                                </span>
                            </td>
                        </tr>
                        <div class="modal fade" id="exampleModal{{ $task->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit your Task</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('task.update', $task->id) }}" method="post"
                                        id="form1">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Task</label>
                                                <input type="text" name="task" class="form-control"
                                                    id="exampleFormControlInput1" value="{{ $task->task }}"
                                                    placeholder="Enter the task">
                                            </div>

                                            <label for="exampleFormControl" class="form-label">Select your priority of
                                                task</label>
                                            <select name="priority" class="form-select"
                                                aria-label="Default select example">

                                                <option @selected($task->priority == 'Low') value="Low">Low</option>
                                                <option @selected($task->priority == 'Medium') value="Medium">Medium</option>
                                                <option @selected($task->priority == 'High') value="High">High</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" id="hide1" class="btn btn-primary">Save
                                                Changes</button>
                                            <button id="loading1" style="display:none;" class="btn btn-primary"
                                                id="show" type="button" disabled>
                                                <span class="spinner-border spinner-border-sm" role="status"
                                                    aria-hidden="true"></span>
                                                Loading...
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModal11{{ $task->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to
                                            delete ?</h1>


                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <br>
                                    <p class="ms-2"> "{{ $task->task }}" will be deleted . </p>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">No</button>
                                        <a href="{{ route('task.delete', $task->id) }}"
                                            class="btn btn-danger">Yes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- <div class="modal fade" id="exampleModal14" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to
                                        delete?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">No</button>
                                    <button type="button" class="btn btn-danger">Yes</button>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    {{-- </td>
                    </tr> --}}
                </tbody>
            </table>



            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample"
                aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Theme</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body" style="display:grid">
                    <div class="row">
                        <div class="column">
                            <img class="select_theme" src="/9.jpg" style="width: 100% " alt="">
                            <img class="select_theme" src="/2.jpg" style="width: 100%" alt="">
                            <img class="select_theme" src="/13.jpg" style="width: 100%" alt="">
                            <img class="select_theme" src="/4.jpg" style="width: 100%" alt="">
                            <img class="select_theme" src="/16.jpg" style="width: 100%" alt="">
                            <img class="select_theme" src="/5.jpg" style="width: 100%" alt="">
                            <img class="select_theme" src="/15.jpg" style="width: 100%" alt="">
                            <img class="select_theme" src="/8.jpg" style="width: 100%" alt="">
                        </div>
                        <div class="column">
                            <img class="select_theme" src="/3.jpg" style="width: 100%" alt="">
                            <img class="select_theme" src="/10.jpg" style="width: 100%" alt="">
                            <img class="select_theme" src="/11.jpg" style="width: 100%" alt="">
                            <img class="select_theme" src="/1.jpg" style="width: 100%" alt="">
                            <img class="select_theme" src="/12.png" style="width: 100%" alt="">
                            <img class="select_theme" src="/14.jpg" style="width: 100%" alt="">
                            <img class="select_theme" src="/7.jpg" style="width: 100%" alt="">
                            <img class="select_theme" src="/6.jpg" style="width: 100%" alt="">
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div style="z-index: 999; width: 200px; " id="contextMenu" class="dropdown clearfix">
        <ul class="dropdown-menu " id="d2" role="menu" aria-labelledby="dropdownMenu">
            <li id="edit"><a class="d1" style="text-decoration: none; color:#5d5a5a;" tabindex="-1"
                    href="#">Edit <i class='fas fa-pen' style='font-size:17px; margin: auto 0;'></i></a>
            </li>
            <li id="delete"><a class="d1" style="text-decoration:none; color:#5d5a5a;" tabindex="-1"
                    href="#">Delete<i class='far fa-trash-alt' style='font-size:17px; margin: auto 0;'></i></a>
            </li>
        </ul>
    </div>
    <a href="{{ route('logout') }}"
        style="position: absolute; right:40px; bottom:40px; background-color:#ffffff82; border-radius:10px; padding:11px 25px; font-size: 20px; color:#0c0c0c; text-decoration:none"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>


    <script>
        $(document).ready(function() {
            $("#form").submit(function() {

                $("#loading").show();
                $("#hide").hide();
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $("#btnn").click(function() {
                $("#list_xy").show().focus();

            });
        });
    </script>

    <script>
        $(function() {
            var store;
            var $contextMenu = $("#contextMenu");

            $("body").on("contextmenu", ".my-menu", function(e) {

                store = $(this).data('id');
                $contextMenu.css({
                    display: "block",
                    left: e.pageX,
                    top: e.pageY
                });
                return false;
            });
            $(".select_theme").click(function() {
                window.location.href = '/list/theme/' + {{ $id }} + '?theme=' + $(this).attr(
                    'src');
            })
            $('#delete').click(function() {
                window.location.href = '/list/delete/' + store;
            });
            $('#edit').click(function() {
                $("#list1" + store).show().focus();
                $("#list" + store).hide();

            });

            $('html').click(function() {
                $contextMenu.hide();
            });

            $("#contextMenu li a").click(function(e) {
                var f = $(this);
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $("#form1").submit(function() {
                $("#loading1").show();
                $("#hide1").hide();
            });

        });
    </script>


</body>

</html>
