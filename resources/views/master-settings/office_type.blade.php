@extends('layouts.dashboard')

<x-master-settings.entity-manager title="Office Type" entity="office-type" id-field="id" :fields="[['name' => 'office_type_name', 'label' => 'Office Type']]" />
