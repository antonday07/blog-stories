<?php

function current_user() {
    return auth()->user();
}
function current_user_id() {
    return auth()->id();
}

