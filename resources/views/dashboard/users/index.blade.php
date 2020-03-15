@extends('layout.dashboard')
@section('body')
    <br>
    <form action="{{ route('dashboard.users.index') }}" method="get">
            <div class="col-md-4">
                <input class="form-control" name="search" style="margin: auto" type="search" value="{{ request()->search }}">

            </div>

            <div class="col-md-4">

                <button type="submit" style="margin:auto " class="btn btn-theme start">
                    <i class="glyphicon glyphicon-search"></i>
                    <span>Search</span>
                </button>
            </div>


    </form>
    <br>

    <br>
    <br>

    <div class="col-md-12">
    <div class="content-panel">
        <h4><i class="fa fa-eye"></i> VIEW USERS</h4><hr><table class="table table-striped table-advance table-hover">


            <thead>
            <tr>
                <th><i ></i>#</th>

                <th><i class="fa fa-bullhorn"></i> FIRST NAME</th>
                <th class="hidden-phone"><i class="fa fa-question-circle"></i> LAST NAME</th>
                <th><i class="fa fa-inbox"></i> E-MAIL</th>
                <th><i class=" fa fa-edit"></i> STATUS</th>
                <th><i class=" fa fa-edit"></i> ACTION</th>
                <th></th>
            </tr>
            </thead>


            <tbody>
            @foreach($users as $index=>$user )

            <tr>
                <td>
                    {{ $index+1}}
                </td>
                <td>
                  {{ $user->first_name }}
                </td>
                <td class="hidden-phone">{{ $user->last_name }}</td>
                <td>{{ $user->email  }} </td>
                <td><span class="label label-info label-mini">Due</span></td>
                <td>
                    @if(auth()->user()->hasPermission('update_users'))
                    <a class="btn btn-success btn-xs" href="{{ route('dashboard.users.edit' , $user->id) }}"><i class="fa fa-pencil"></i></a>
                  @else
                        <a disabled class="btn btn-success btn-xs" href="{{ route('dashboard.users.edit' , $user->id) }}"><i class="fa fa-pencil"></i></a>

                    @endif
                    @if(auth()->user()->hasPermission('delete_users'))
                    <form style="display: inline-block" action="{{ route('dashboard.users.destroy' , $user->id) }}" method="post">
                        <input  type="hidden" name="_token"  value="{{ Session::token() }}" />
                        {{  method_field('delete') }}
                        <button onclick="return confirm('Are you sure you want to delete this item')" type="submit"><i  class="fa fa-trash-o"></i></button>
                    </form>
                        @else
                            <a disabled class="btn btn-danger btn-xs" href="{{ route('dashboard.users.edit' , $user->id) }}"><i class="fa fa-trash-o"></i></a>
                        @endif
                </td>
            </tr>
            @endforeach

            </tbody>

        </table>
        {{  $users->appends(request()->query())->links() }}

    </div>
    <!-- /content-panel -->
</div>
    @endsection