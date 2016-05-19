<div class="modal fade gf-modal" id="create-affiliate-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['url' => '/admin/affiliates', 'class' => 'form-horizontal gf-form modal-form']) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create a new affiliate</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Name: </label>
                    {!! Form::text('name', null, ['class' => "form-control"]) !!}
                </div>
                <div class="form-group">
                    <label for="description">Description: </label>
                    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label for="website">Website: </label>
                    {!! Form::text('website', null, ['class' => "form-control"]) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn gf-btn btn-light gf-modal-cancel-btn" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn gf-btn gf-modal-confirm-btn">Create</button>
            </div>
            {!! Form::close() !!}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->