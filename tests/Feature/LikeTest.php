<?php
test('user can like note', function () {
    $response = $this->post('/notes/{id}/like', [
        '_token' => csrf_token(),
        'user_id' => 1,
        'note_id' => 1,
    ]);
});
