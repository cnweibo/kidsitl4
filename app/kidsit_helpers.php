<?php
function set_active($path,$active_class = 'active')
{
	return Request::is($path) ? "class=$active_class" : '';
}