@include('admin.writeups.show', [
    'deleteFormAction' => '/admin/consulting/'.$writeup->id,
    'editUrl' => '/admin/consulting/'. $writeup->id .'/edit'
])