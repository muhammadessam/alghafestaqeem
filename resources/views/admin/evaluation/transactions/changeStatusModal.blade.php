<div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">تغيير حالة الطلب</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="changeStatusForm" action="" method="post"
                onsubmit="return confirm('هل تريد تغيير حالة الطلب ؟');">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="status" class="col-form-label">الحالة:</label>
                        <select class="form-control" name="status" id="status">
                            <option>كل الحالات</option>
                            @foreach ($result['statuses'] as $status)
                                <option {{ old('status') == $status['id'] ? 'selected' : '' }}
                                    value="{{ $status['id'] }}">
                                    {{ __('admin.' . $status['title']) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">حفظ</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">إلغاء</button>
                </div>
            </form>

        </div>
    </div>
</div>
