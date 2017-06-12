@extends('admin.layouts.master')

@section('content')
{{--{{ Html::ul($errors->all()) }}--}}
<div class="row">
    <div class="col-sm-10 col-sm-offset-2">
        <h1>{{ trans('admin/products.create-add_new') }}</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
    </div>
</div>
{!! Form::open(array('files' => true, 'route' => 'admin.products.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}

<div class="form-group">
    {!! Form::label('barcode', 'Barcode*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('barcode', old('barcode'), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('store_price', 'Vendor Price*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('store_price', old('store_price'), array('class'=>'form-control')) !!}
        
    </div>
</div>

<div class="form-group">
    {!! Form::label('psc', 'PSC (Product Site Commission in %)*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('psc', old('psc'), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('vpc', 'VPC (Vendor Product Commission in %)*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('vpc', old('vpc'), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('description', 'Primary Description*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('description', old('description'), array('class'=>'form-control')) !!}
        
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', 'Brand*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('name', old('name'), array('class'=>'form-control')) !!}
        
    </div>
</div>

<div class="form-group">
    {!! Form::label('brand_family', 'Brand Family', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('brand_family', old('brand_family'), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('product_group', 'Product Group', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('product_group', old('product_group'), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('units_per_pack', 'Units per Pack', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('units_per_pack', old('units_per_pack'), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('size', 'Size', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('size', old('size'), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('product_marketing', 'Main Product Description', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('product_marketing', old('product_marketing'), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('features', 'Features', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('features', old('features'), array('class'=>'form-control')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('servings_washes', 'Serves', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('servings_washes', old('servings_washes'), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('abv', 'ABV', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('abv', old('abv'), array('class'=>'form-control')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('regulated_product_name', 'Regulated Product Name', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('regulated_product_name', old('regulated_product_name'), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('alcohol_region_of_origin', 'Country of Origin', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('alcohol_region_of_origin', old('alcohol_region_of_origin'), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('alcohol_grape_variety', 'Varietal', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('alcohol_grape_variety', old('alcohol_grape_variety'), array('class'=>'form-control')) !!}
        
    </div>
</div>

<div class="form-group">
    {!! Form::label('lower_age_limit_new', 'Lower Age Limit', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::checkbox('lower_age_limit_new','1', null, []) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('ingredients', 'Ingredients', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('ingredients', old('ingredients'), array('class'=>'form-control')) !!}
        
    </div>
</div>

<div class="form-group">
    {!! Form::label('safety_warnings', 'Safety Warning', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('safety_warnings', old('safety_warnings'), array('class'=>'form-control')) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('packaging', 'Packaging', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('packaging', old('packaging'), array('class'=>'form-control')) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('height', 'Measurements Height', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('height', old('height'), array('class'=>'form-control')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('width', 'Measurements Width', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('width', old('width'), array('class'=>'form-control')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('depth', 'Measurements Depth', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('depth', old('depth'), array('class'=>'form-control')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('weight', 'Measurements Weight', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('weight', old('weight'), array('class'=>'form-control')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('per100_energy_kcal', 'Energy (kcal)', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('per100_energy_kcal', old('per100_energy_kcal'), array('class'=>'form-control')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('per100_fat', 'Fat (g)', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('per100_fat', old('per100_fat'), array('class'=>'form-control')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('per100_thereof_sat_fat', 'Saturates fat (g)', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('per100_thereof_sat_fat', old('per100_thereof_sat_fat'), array('class'=>'form-control')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('per100_thereof_total_sugar', 'Sugars (g)', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('per100_thereof_total_sugar', old('per100_thereof_total_sugar'), array('class'=>'form-control')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('per100_salt', 'Salt (g)', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('per100_salt', old('per100_salt'), array('class'=>'form-control')) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('meta_keywords', 'Meta Keywords', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('meta_keywords', old('meta_keywords'), array('class'=>'form-control')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('meta_description', 'Meta Description', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('meta_description', old('meta_description'), array('class'=>'form-control')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('version_date', 'Version Date', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('version_date', old('version_date'), array('class'=>'form-control')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('in_data_feed', 'Include in Data Feeds', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::checkbox('in_data_feed','1', null, []) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('is_popular', 'Is Popular?', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::checkbox('is_popular','1', null, []) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('is_gifts', 'Is Gift?', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::checkbox('is_gifts','1', null, []) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('allergy_advice', 'Allergy Advice 1', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('allergy_advice', old('allergy_advice'), array('class'=>'form-control')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('allergy_other_text', 'Allergy Advice 2', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('allergy_other_text', old('allergy_other_text'), array('class'=>'form-control')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('nut_statement', 'Allergy Advice 3', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('nut_statement', old('nut_statement'), array('class'=>'form-control')) !!}
    </div>
</div>


<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
    {!! Form::submit(trans('admin/products.create'), ['class' => 'btn btn-primary']) !!}
        </div>
</div>

{!! Form::close() !!}

@stop

