@include('layouts.header')
<!-- /. NAV SIDE  -->

<div id="page-wrapper">
    <div class="header">
        <h1 class="page-header">
            Dashboard
            <small>Welcome John Doe</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Data</li>
        </ol>

    </div>
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Advanced Tables
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="dataTables_length" id="dataTables-example_length"><label>
                                            {{--<select--}}
                                            {{--name="dataTables-example_length"--}}
                                            {{--aria-controls="dataTables-example"--}}
                                            {{--class="form-control input-sm">--}}
                                            {{--<option value="10">10</option>--}}
                                            {{--<option value="25">25</option>--}}
                                            {{--<option value="50">50</option>--}}
                                            {{--<option value="100">100</option>--}}
                                            {{--</select> records per page</label>--}}
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div id="dataTables-example_filter" class="dataTables_filter">
                                            <label>Search:<input type="search" class="form-control input-sm"
                                                                 aria-controls="dataTables-example"></label></div>
                                    </div>
                                </div>
                                <table class="table table-striped table-bordered table-hover dataTable no-footer"
                                       id="dataTables-example" aria-describedby="dataTables-example_info">
                                    <thead>
                                    <tr role="row">

                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTables-example"
                                            rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="Rendering engine: activate to sort column ascending"
                                            style="width: 100px;">序号
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending"
                                            style="width: 352px;">昵称
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending"
                                            style="width: 352px;">手机号
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                            style="width: 321px;">邮箱
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Engine version: activate to sort column ascending"
                                            style="width: 195px;">添加时间
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending"
                                            style="width: 139px;">操作
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $vo)
                                        <tr class="gradeA odd">
                                            <td class="sorting_1">{{$vo->id}}</td>
                                            <td class="sorting_1">{{$vo->name}}</td>
                                            <td class=" ">{{$vo->mobile}}</td>
                                            <td class=" ">{{$vo->email}}</td>
                                            <td class="center ">{{$vo->created_at}}</td>
                                            <td class="center ">
                                                <a href="{{route('user.edit',['id'=>$vo->id])}}" >
                                                    编辑
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="dataTables_info" id="dataTables-example_info" role="alert"
                                             aria-live="polite" aria-relevant="all">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="dataTables_paginate paging_simple_numbers"
                                             id="dataTables-example_paginate">
                                            {!! $users->render() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>


    </div>
    <!-- /. PAGE INNER  -->
</div>
@include('layouts.footer')
