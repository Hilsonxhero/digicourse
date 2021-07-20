
    <div class="profile__info border cursor-pointer text-center">

        <div class="avatar__img"><img src="{{auth()->user()->image()}}" alt="" class="avatar___img">
            <input type="file" name="thumb" accept="image/*" class="hidden avatar-img__input">
            <div class="v-dialog__container" style="display: block;"></div>
            <div class="box__camera default__avatar"></div>
        </div>
        <span class="profile__name">کاربر :  {{auth()->user()->name}}</span>
    </div>

