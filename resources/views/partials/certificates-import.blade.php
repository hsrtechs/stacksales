<div class="row">
    <div class="col-md-12 text-center">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".import-model">Import</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".export-model">Export</button>
        <div class="modal fade import-model" tabindex="-1" role="dialog" aria-labelledby="Import">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        Import Data
                    </div>
                    <div class="modal-body">
                        <form class="form" id="#import" enctype="multipart/form-data" method="POST" action="{{ route('Certificate.upload',[$company->id,csrf_token()]) }}">
                            <div class="form-group">
                                <input type="file" name="uploadFile" required>
                            </div>
                            {{ csrf_field() }}
                            <input type="hidden" value="{!! urlencode(json_encode($certificates)) !!}" name="data">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" form="#import">Upload</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade export-model" tabindex="-1" role="dialog" aria-labelledby="Export">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        Export Data
                    </div>
                    <div class="modal-body">
                        <form class="form" id="#export" method="get" action="{{ route('Certificate.download',csrf_token()) }}" target="_blank">
                            <div class="form-group">
                                <select name="type" class="form-control">
                                    <option value="xlsx">Excel/xlsx</option>
                                    <option value="xls">Excel/xls</option>
                                    <option value="csv">Excel/csv</option>
                                </select>
                            </div>
                            {{ csrf_field() }}
                            <input type="hidden" value="{!! urlencode(json_encode($certificates)) !!}" name="data">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" form="#export">Download</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
