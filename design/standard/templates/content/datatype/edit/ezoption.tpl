<input type="text" name = "ContentObjectAttribute_data_option_name_{$attribute.id}" value="{$attribute.content.name}"><br />

Options:<br />
{section name=OptionList loop=$attribute.content.option_list sequence=array(bglight,bgdark)}

<input type="hidden" name = "ContentObjectAttribute_data_option_id_{$attribute.id}[]" value="{$OptionList:item.id}">
<input type="text" name = "ContentObjectAttribute_data_option_value_{$attribute.id}[]" value="{$OptionList:item.value}">
<input type="checkbox" name = "ContentObjectAttribute_data_option_remove_{$attribute.id}[]" value="{$OptionList:item.id}" >

<br />

{/section}

<input type="submit" name="CustomActionButton[{$attribute.id}_new_option]" value="{'New option'|i18n}" />
<input type="submit" name="CustomActionButton[{$attribute.id}_remove_selected]" value="{'Remove Selected'|i18n}" />
<br />
