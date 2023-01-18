@extends('admin.layouts.base')

@section('content')
    @include('admin.layouts.components.header', [
        'title' => __('messages.list', [
            'name' => trans_choice('content.petcategory', 2),
        ]),
        'breadcrumbs' => Breadcrumbs::render('admin.categorys.index'),
        'filter' => false,
        'create_btn' => [
            'status' => true,
            'route' => route('admin.categorys.create'),
            'name' => __('messages.create', [
                'name' => trans_choice('content.categorys', 1),
            ]),
        ],
    ])
    @include('admin.layouts.components.datatable_header', [
        'data' => [
            ['classname' => '', 'title' => trans_choice('content.id_title', 1)],
            ['classname' => 'min-w-125px', 'title' => trans_choice('content.cat_name', 1)],
            ['classname' => 'min-w-125px', 'title' => trans_choice('content.cat_image', 1)],
        ],
    ])
@endsection

@push('scripts')
    <script>
        var oTable;
        $(document).ready(function() {
            oTable = $('#kt_table_1').DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                order: [
                    [0, 'desc']
                ],
                oLanguage: {
                    sLengthMenu: "Show _MENU_",
                },
                createdRow: function(row, data, dataIndex) {
                    // Set the data-status attribute, and add a class
                    $(row).attr('role', 'row');
                    $(row).find("td").last().addClass('text-danger');
                },
                ajax: {
                    "url": "{{ route('admin.categorys.index') }}",
                    data: function(d) {
                        d.name = $('input[name=name]').val();
                        d.advisory_id = $('input[name=cat_id]').val();
                        d.status = $('select[name=status]').val();
                    },
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return data;
                            // return "#" + serialNumberShow(meta);
                        }
                    },

                    {
                        data: 'name',
                        name: 'name',
                        render: function(data, type, row, meta) {
                            var show_url = `{{ url('/') }}/admin/categorys/` + row['id'] + `?tab=details`;
                            return ` <div class="font-medium whitespace-no-wrap">${data}</div> `;
                        }
                    },
                    {
                        data: 'cat_image',
                        name: 'cat_iamge',
                        render: function(data, type, row, meta) {
                            return `<div class="font-medium whitespace-no-wrap"><img src="{{url('/') }}/petcategory/image/${data}" height="50"></div>`;
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row, meta) {
                            var data_status1='';
                            if(data==0){
                                data_status1="Active";
                                data_status2=0;
                             }else if(data==1){
                                data_status1="Deactive";
                            } 

                        // var status_url = `{{ url('/') }}/admin/users/` + row['id'] +
                        //         `/`+data_status2;
                        if(data==0){    
                        return ` 
                                        <div class="font-medium whitespace-no-wrap" style="color:green">${data_status1}</div>
                                    `;
                        }else{
                            return ` 
                                        <div class="font-medium whitespace-no-wrap" style="color:red">${data_status1}</div>
                                    `; 
                        }

                           }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        // visible:false,
                        render: function(data, type, row, meta) {

                            var edit_url = `{{ url('/') }}/admin/advisorys/` + row['id'] +
                                `/edit/?tab=edit`;
                            // var show_url = `{{ url('/') }}/admin/advisorys/` + row['id'] +
                            //     `?tab=details`;

                            var edit_data = actionEditButton(edit_url, row['id']);
                            // var show_data = actionShowButton(show_url);

                            var del_data = actionDeleteButton(row['id']);
                            return `<div class="flex justify-left items-center"> ${edit_data} ${del_data} </div>`;

                            // return `<div class="flex justify-left items-center"> ${button} </div>`;

                        }
                    },
                ],
            });
            //start: datatables common js file for changing
            oTable.columns().iterator('column', function(ctx, idx) {
                $(oTable.column(idx).header()).append('<span class="sort-icon"/>');
            });
            //end: datatables common js file for changing
        });

        $(document).on('click', '.clsdelete', function() {
            var id = $(this).attr('data-id');
            var e = $(this).parent().parent();
            var url = `{{ url('/') }}/admin/advisorys/` + id;
            tableDeleteRow(url, oTable);
        });

        $(document).on('click', '.clsstatus', function() {
            var id = $(this).attr('data-id');
            var status = $(this).attr('data-status');
            var url = `{{ url('/') }}/admin/advisorys/status/` + id + `/` + status;
            tableChnageStatus(url, oTable);
        });
    </script>

    <script>
        $('#extraSearch').on('click', function() {
            //extraSearch is id of search button....
            oTable.draw();
        });

        $(document).on('click', '#searchReset', function(e) {
            $('#filter_data').trigger("reset");
            e.preventDefault();
            oTable.draw();
        });

        $(document).on('click', '.drawerReset', function(e) {
            $('#filter_data').trigger("reset");
            e.preventDefault();
            oTable.draw();
        });

        $(document).ready(function() {
            $('#filter_data').trigger("reset");
            oTable.draw();
        });

        $(document).on('click', '#search_filter_excel_download', function(e) {
            var export_type = $(this).attr('data-type');
            console.log(export_type);
            $('#export_type').val(export_type);
            $('#filter_data').submit();
        });
    </script>
@endpush
