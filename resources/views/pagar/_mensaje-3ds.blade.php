@if( isset($error3DS) && is_string($error3DS) )
<div class="alert alert-danger text-center">{{ $error3DS }}</div>
@endif
<script>if("function"==typeof window.history.replaceState){let u=window.location.toString();if(u.indexOf("?")>0){let c=u.substring(0,u.indexOf("?"));window.history.replaceState({},document.title,c)}}</script>

<?php
/*
<script>
if (typeof window.history.replaceState == 'function')
{
    let uri = window.location.toString();

    if (uri.indexOf("?") > 0) 
    {
        let clean_uri = uri.substring(0, uri.indexOf("?"));
        window.history.replaceState({}, document.title, clean_uri);
    }
}
// https://developer.mozilla.org/en-US/docs/Web/API/History/replaceState
// https://developer.mozilla.org/en-US/docs/Web/API/URLSearchParams/delete
</script>
*/
?>
