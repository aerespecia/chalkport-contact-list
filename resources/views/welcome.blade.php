@extends('layouts.main')

@section('content')
<div class="layout-content">
<div class="layout-content-body">

<div class="title-bar">
    <h4>
      <span class="d-ib"></span>
        Contact List &nbsp;<button class="btn btn-primary" data-toggle="modal" data-target="#newcontact-modal"><span class="icon icon-plus"></span> Add New Contact</button>
    </h4>
    <p class="title-bar-description">
      <small></small>
    </p>
</div>
<br/>

<div class="row">
  <div class="col-md-10">
<div class="card">
  <div class="card-body">
      <table id="contact-list-table" class="table table-striped table-nowrap dataTable fixedHeader" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Address</th>
                <th>Notes</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                <script>
                    $(document).ready(function() {

                        var DataTable = $.fn.dataTable;
                         $.extend(true, DataTable.Buttons.defaults, {
                          dom: {
                            button: {
                              className: 'btn btn-outline-primary btn-sm'
                            }
                          }
                        });

                       $('#contact-list-table').DataTable({
                          buttons: ['pageLength'],
                          ajax: '/showAllContacts',
                          lengthChange: false,
                          responsive: true,
                          "order": [[2,'asc']],
                          sScrollY: "400px",
                          paginate:false,
                          dom: 'Bftrip',
                         'columns': [
                                { 'data': 'name' },
                                { 'data': 'email' },
                                { 'data': 'contact_number' },
                                { 'data': 'address' },
                                { 'data': 'notes' },
                                {
                                  "className": 'options',
                                  "data":    null,
                                  "render": function(data, type, full, meta){
                                      var valueHere=data.id;

                                      return '<button type="button" data-toggle="modal" data-target="#newcontact-modal" title="" class="btn btn-sm btn-info" data-id="1" value="'+valueHere+'"><span class="icon icon-edit"></span></button>&nbsp;&nbsp;<button type="button" data-toggle="modal" data-target="#deletecontact-modal" title="" class="btn btn-sm btn-light" data-id="2" value="'+valueHere+'"><span class="icon icon-trash"></span></button>';
                                    }

                                },

                            ],
                          language: {
                            paginate: {
                              previous: '&laquo;',
                              next: '&raquo;'
                            },
                            search: "_INPUT_",
                            searchPlaceholder: "Search…"
                          },


                        });

                       $('#contact-list-table tbody').on( 'click', 'button', function () {

                        var id = $(this).attr("data-id");

                        if(id==1) {

                            $.get("/contact/"+$(this).val(), function(data){
                                $("#name").val(data["name"]);
                                $("#email").val(data["email"]);
                                $("#contactNumber").val(data["contact_number"]);
                                $("#address").val(data["address"]);
                                $("#notes").val(data["notes"]);
                            });

                            $("#saveContact").val($(this).val());

                        }

                        if(id==2) {
                            $.get("/contact/"+$(this).val(), function(data){
                                $("#del-contact-name").html(data["name"]);
                                $("#del-contact-btn").val(data["id"]);
                            });
                        }

                      });

                      });

                </script>
            </tbody>
          </table>
    </div>

  </div>
</div>

</div>
<div class="col-md-5">

    </div>

</div>
</div>
<div id="deletecontact-modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
            <span class="sr-only">Close</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="text-center">
            <span class="text-primary icon icon-trash icon-5x"></span>
            <h3 class="text-primary">Remove Contact</h3>
            <p>Do you want to remove <strong><span id="del-contact-name"></span></strong> from your contact list?
              <br><span><em>Note: You can still bring this guy back. Don't worry ;)</em></span></p>
            <div class="m-t-lg">
              <button class="btn btn-primary" data-dismiss="modal" type="button">No</button>
              <button class="btn btn-light" data-dismiss="modal" type="button" id="del-contact-btn" value="0">Yes, I want to remove</button>
            </div>
          </div>
        </div>
        <div class="modal-footer"></div>
      </div>
    </div>
  </div>
<div id="newcontact-modal" tabindex="-1" role="dialog" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">×</span>
          <span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title"><span class="icon icon-user-plus"></span>&nbsp; Add New Contact</h4>

      </div>
      <div class="modal-body">

      <form class="form" id="contact-form" enctype="multipart/form-data">
          <div class="row gutter-xs">
            <div class="col-md-4">
              <div class="row">

                <div class="col-md-6">
                  <br/>
                  <input id="avatar" type="file" accept="image/*">
                  <p class="help-block">
                    <small>Upload photo </small>
                  </p>
                </div>
              </div>

            </div>

          </div><br/>
          <div class="row gutter-xs">
          <div class="col-md-4">

              <div class="form-group">
                    <label for="email-1">Name</label>
                    <input class="form-control" type="text" name="name" id="name">
              </div>
            </div>
            <div class="col-md-4">

              <div class="form-group">
                    <label for="email-1">Email</label>
                    <input class="form-control" type="text" name="email" id="email">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                    <label for="email-1">Contact Number</label>
                    <input class="form-control" type="text" name="contactNumber" id="contactNumber">
              </div>
            </div>

          </div>

          <div class="row gutter-xs">

            <div class="col-md-4">
                <div class="form-group">
                    <label for="email-1">Address</label>
                    <input class="form-control" type="text" name="address" id="address">
                </div>
            </div>


            <div class="col-md-8">

              <div class="form-group">
                <div class="form-group">
                    <label for="email-1">Notes</label>
                    <input class="form-control" type="text" name="address" id="notes">
                </div>
              </div>
            </div>

          </div>



          <br/>


          <div class="row">
            <div class="col-md-12">
              <button class="btn btn-lg btn-primary btn-block" id="saveContact" value="0" type="button">Save</button>
            </div>

          </div>

          </form>

    </div>
  </div>
</div>
</div>

<script>
$(document).ready(function(){
    $('#del-contact-btn').click(function(e){
        var id = $(this).val();
        $.ajax({
            type:"POST",
            url: "contact/"+id,
            headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
            success: function (data){
                var title   = 'Success!',
                    message = "You've successfully removed "+data+" from Contact List",
                    type    = 'success',
                    options = {};

                $('#delcontact-modal').modal('toggle');
                toastr[type](message, title, options);

                $('#contact-list-table').DataTable({
                    buttons: ['pageLength'],
                    ajax: '/showAllContacts',
                    lengthChange: false,
                    responsive: true,
                    bDestroy: true,
                    "order": [[2,'asc']],
                    sScrollY: "400px",
                    paginate:false,
                    dom: 'Bftrip',
                    'columns': [
                        { 'data': 'name' },
                        { 'data': 'email' },
                        { 'data': 'contact_number' },
                        { 'data': 'address' },
                        { 'data': 'notes' },
                        {
                            "className": 'options',
                            "data":    null,
                            "render": function(data, type, full, meta){
                                var valueHere=data.id;

                                return '<button type="button" data-toggle="modal" data-target="#newcontact-modal" title="" class="btn btn-sm btn-info" data-id="1" value="'+valueHere+'"><span class="icon icon-edit"></span></button>&nbsp;&nbsp;<button type="button" data-toggle="modal" data-target="#deletecontact-modal" title="" class="btn btn-sm btn-light" data-id="2" value="'+valueHere+'"><span class="icon icon-trash"></span></button>';
                                }

                        },

                    ],
                    language: {
                    paginate: {
                        previous: '&laquo;',
                        next: '&raquo;'
                    },
                    search: "_INPUT_",
                    searchPlaceholder: "Search…"
                    },


                });

                $("#name").val('');
                $("#email").val('');
                $("#contactNumber").val('');
                $("#address").val('');
                $("#notes").val('');
                $("#saveContact").val(0);
            }
        });
    });

    $('#saveContact').click(function(e){
    e.preventDefault();

    var contactInfo = {
        name: $('#name').val(),
        email: $('#email').val(),
        contactNumber: $('#contactNumber').val(),
        address: $('#address').val(),
        notes: $('#notes').val(),
        action: 1,
        id: $(this).attr('value'),
    };

    if(contactInfo.id == 0) {
        $.ajax({
            type:"POST",
            url: "/contact",
            data: contactInfo,
            headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
            success: function (data){
                //console.log(data);
                var title   = 'Success!',
                    message = "You've successfully added "+data+" to Contact List",
                    type    = 'success',
                    options = {};

                $('#newcontact-modal').modal('toggle');
                toastr[type](message, title, options);

                $('#contact-list-table').DataTable({
                    buttons: ['pageLength'],
                    ajax: '/showAllContacts',
                    lengthChange: false,
                    responsive: true,
                    bDestroy: true,
                    "order": [[2,'asc']],
                    sScrollY: "400px",
                    paginate:false,
                    dom: 'Bftrip',
                    'columns': [
                        { 'data': 'name' },
                        { 'data': 'email' },
                        { 'data': 'contact_number' },
                        { 'data': 'address' },
                        { 'data': 'notes' },
                        {
                            "className": 'options',
                            "data":    null,
                            "render": function(data, type, full, meta){
                                var valueHere=data.id;

                                return '<button type="button" data-toggle="modal" data-target="#newcontact-modal" title="" class="btn btn-sm btn-info" data-id="1" value="'+valueHere+'"><span class="icon icon-edit"></span></button>&nbsp;&nbsp;<button type="button" data-toggle="modal" data-target="#deletecontact-modal" title="" class="btn btn-sm btn-light" data-id="2" value="'+valueHere+'"><span class="icon icon-trash"></span></button>';
                                }

                        },

                    ],
                    language: {
                    paginate: {
                        previous: '&laquo;',
                        next: '&raquo;'
                    },
                    search: "_INPUT_",
                    searchPlaceholder: "Search…"
                    },


                });

                $("#name").val('');
                $("#email").val('');
                $("#contactNumber").val('');
                $("#address").val('');
                $("#notes").val('');
                $("#saveContact").val(0);
            }
        });
    }

    $.ajax({
        type:"PUT",
        url: "/contact/"+contactInfo.id,
        data: contactInfo,
        headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
        success: function (data){
            var title   = 'Success!',
                message = "You've successfully updated "+data+" to Contact List",
                type    = 'success',
                options = {};


            $('#contact-list-table').DataTable({
                buttons: ['pageLength'],
                ajax: '/showAllContacts',
                lengthChange: false,
                responsive: true,
                bDestroy: true,
                "order": [[2,'asc']],
                sScrollY: "400px",
                paginate:false,
                dom: 'Bftrip',
                'columns': [
                    { 'data': 'name' },
                    { 'data': 'email' },
                    { 'data': 'contact_number' },
                    { 'data': 'address' },
                    { 'data': 'notes' },
                    {
                        "className": 'options',
                        "data":    null,
                        "render": function(data, type, full, meta){
                            var valueHere=data.id;

                            return '<button type="button" data-toggle="modal" data-target="#newcontact-modal" title="" class="btn btn-sm btn-info" data-id="1" value="'+valueHere+'"><span class="icon icon-edit"></span></button>&nbsp;&nbsp;<button type="button" data-toggle="modal" data-target="#deletecontact-modal" title="" class="btn btn-sm btn-light" data-id="2" value="'+valueHere+'"><span class="icon icon-trash"></span></button>';
                            }

                    },

                ],
                language: {
                paginate: {
                    previous: '&laquo;',
                    next: '&raquo;'
                },
                search: "_INPUT_",
                searchPlaceholder: "Search…"
                },


            });

            $("#name").val('');
            $("#email").val('');
            $("#contactNumber").val('');
            $("#address").val('');
            $("#notes").val('');
            $("#saveContact").val(0);
            $('#newcontact-modal').modal('toggle');
            toastr[type](message, title, options);
        }
    });

    });
});


</script>

@endsection
