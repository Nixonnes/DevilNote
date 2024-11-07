<?php

it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
test('the guest cannot create notes' , function () {
    $response = $this->post('/notes/create', [
        'title' => 'Test title',
        'content' => 'Test content',
    ]);
    $response->assertRedirect('/login'); // Проверяем, что перенаправило на страницу входа
});
test('the user can create notes', function () {
    $response = $this->post('/notes/create', [
        'user_id' => 1,
        'title' => 'Test title',
        'content' => 'Test content',
    ]);
    $response->assertRedirect(route('notes.show', ['id' => 1]));
});

