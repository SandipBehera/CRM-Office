@php
    use App\Models\LeadsComment;
@endphp
@extends('layouts.adminlayout.admin_design')
@section('content')

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-news-paper"></i>
                    </div>
                    <div>All Leads

                    </div>
                </div>

             </div>
        </div>

              <div class="row">

                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-header">All Leads
                                <div class="pull-right" style="float:right;margin-left:75%" >
                                <a href="{{url('/admin/upload-leads')}}" class="btn mr-2 mb-2 btn-primary" target="blank"><i class="pe-7s-plus"></i>
                                        Upload Leads</a>
                                </div>
                                    </div>
                            <div class="card-body">

                                <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>email</th>
                                        <th>mobile</th>
                                        <th>Leads From</th>
                                        <th>Leads For</th>
                                        <th>Assigned To</th>
                                        <th>status</th>
                                        <th>Comment</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                     @foreach ($Alldata as $item)
                                        @php
                                            $leads_comment=LeadsComment::where(['lead_id'=>$item->id])->get();
                                        @endphp
                                     <tr>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email_id}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>{{$item->leads_from}}</td>
                                        <td>{{$item->leads_for}}</td>
                                        @if ($item->asssigned_to!=NULL)
                                        <td>{{$item->asssigned_to}}</td>
                                        @else
                                        <td> <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal"
                                        data-target=".bd-example-modal-lg" id="Leads" value="{{$item->id}}">Assign</button></td>
                                        @endif

                                        @if ($item->status!=null)
                                        <td class="text-center">
                                        <button type="button" id="PopoverCustomT-1"
                                            class="btn btn-primary btn-sm">{{$item->status}}</button></td>
                                        @else
                                        <td>
                                            <select name="update_status" class="form-control-sm form-control" >
                                            <option value="new">New</option>
                                            <option value="contacted">Contacted</option>
                                            <option value="qualified">Qualified</option>
                                            <option value="closed">Closed</option>
                                            </select>
                                        </td>
                                        @endif
                                        @if (!empty($leads_comment))
                                        @php
                                            $j=1;
                                        @endphp
                                        <td>
                                            @foreach ($leads_comment as $item_comment)
                                            {{$j++}}. {{$item_comment->comment}}<br>
                                            @endforeach
                                        </td>
                                        @else
                                        <td><p>No progress</p></td>
                                        @endif
                                    </tr>
                                     @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                 </div>
            </div>
    </div>
    <!-- Large modal -->


@endsection
