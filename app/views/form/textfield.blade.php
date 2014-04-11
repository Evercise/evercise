@extends('form.formitem')

{{ Form::text( $fieldname , '', array('placeholder' => $placeholder, 'maxlength' => $maxlength), Input::old('userName'))}}