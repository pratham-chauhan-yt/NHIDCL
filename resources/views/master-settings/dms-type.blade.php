@extends('layouts.dashboard')

<x-master-settings.entity-manager title="DMS Type" entity="dms-type" id-field="id" :fields="[['name' => 'type', 'label' => 'Type Name']]" />
