{{-- Email Modal --}}


<div class="modal" id="emailAdminModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Email - {{$user->firstName . " " . $user->lastName}}</h4>
            <hr>
        </div>
        <div class="modal-body">
            <form>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="userEmail" id="userEmail" class="form-control"           placeholder="Enter Medicine" value="{{ $user->email }}" readonly>
                    </div>

                    @if ($errors->has('userEmail'))
                        <span class="help-block" style="color:red;" role="alert">
                            <small><b>{{ $errors->first('userEmail') }}</b></small>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <div class="form-line">
                        <label for="emailMsg" class="control-label">Message:</label>
                        <textarea class="form-control" id="emailMsg" required></textarea>
                    </div>

                    @if ($errors->has('emailMsg'))
                        <span class="help-block" style="color:red;" role="alert">
                            <small><b>{{ $errors->first('emailMsg') }}</b></small>
                        </span>
                    @endif
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary">Send Email</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>