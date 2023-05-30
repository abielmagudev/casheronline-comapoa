<?php foreach(['primary','success','warning','danger','info'] as $type_message): ?>
@if( session($type_message) )
<div class="alert alert-{{ $type_message }} text-center">{!! session($type_message) !!}</div>
@endif
<?php endforeach ?>
