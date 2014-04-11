@extends('form.formitem')

{{ Form::select( $fieldname , array(1=>'Male', 2=>'Female')) }}