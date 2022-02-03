# InventoryPhysicalCount

## Properties
Name | Getter | Setter | Type | Description | Notes
------------ | ------------- | ------------- | ------------- | ------------- | -------------
**id** | getId() | setId($value) | **string** | A unique ID generated by Square for the [InventoryPhysicalCount](#type-inventoryphysicalcount). | [optional] 
**reference_id** | getReferenceId() | setReferenceId($value) | **string** | An optional ID provided by the application to tie the [InventoryPhysicalCount](#type-inventoryphysicalcount) to an external system. | [optional] 
**catalog_object_id** | getCatalogObjectId() | setCatalogObjectId($value) | **string** | The Square generated ID of the [CatalogObject](#type-catalogobject) being tracked. | [optional] 
**catalog_object_type** | getCatalogObjectType() | setCatalogObjectType($value) | **string** | The [CatalogObjectType](#type-catalogobjecttype) of the [CatalogObject](#type-catalogobject) being tracked. Tracking is only supported for the &#x60;ITEM_VARIATION&#x60; type. | [optional] 
**state** | getState() | setState($value) | **string** | The current [InventoryState](#type-inventorystate) for the related quantity of items. | [optional] 
**location_id** | getLocationId() | setLocationId($value) | **string** | The Square ID of the [Location](#type-location) where the related quantity of items are being tracked. | [optional] 
**quantity** | getQuantity() | setQuantity($value) | **string** | The number of items affected by the physical count as a decimal string. Fractional quantities are not supported. | [optional] 
**source** | getSource() | setSource($value) | [**\SquareConnect\Model\SourceApplication**](SourceApplication.md) | Read-only information about the application that submitted the physical count. | [optional] 
**employee_id** | getEmployeeId() | setEmployeeId($value) | **string** | The Square ID of the [Employee](#type-employee) responsible for the physical count. | [optional] 
**occurred_at** | getOccurredAt() | setOccurredAt($value) | **string** | A client-generated timestamp in RFC 3339 format that indicates when the physical count took place. For write actions, the &#x60;occurred_at&#x60; timestamp cannot be older than 24 hours or in the future relative to the time of the request. | [optional] 
**created_at** | getCreatedAt() | setCreatedAt($value) | **string** | A read-only timestamp in RFC 3339 format that indicates when Square received the physical count. | [optional] 

Note: All properties are protected and only accessed via getters and setters.

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)
