@extends('layouts.dashboard')

<x-master-settings.entity-manager title="Conducting Agency" entity="conducting-agency" id-field="id" :fields="[['name' => 'agency_name', 'label' => 'Conducting Agency Name']]" />
