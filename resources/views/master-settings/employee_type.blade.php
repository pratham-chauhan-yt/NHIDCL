@extends('layouts.dashboard')

<x-master-settings.entity-manager title="Employee Type" entity="employee-type" id-field="id" :fields="[['name' => 'name', 'label' => 'Employee Type']]" />
