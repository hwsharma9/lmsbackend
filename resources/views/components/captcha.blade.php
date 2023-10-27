<div class="form-group">
    <img src="{{Captcha::src('flat')}}" class="captcha-image"> <a href="javascript:void(0)" class="refresh-captcha"><i class="fas fa-arrows-alt"></i></a>
    <input type="text" name="captcha" class="form-control @error('captcha') is-invalid @enderror" placeholder="Enter Captcha" value="" style="width: 100%;" />
    @error('captcha')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>