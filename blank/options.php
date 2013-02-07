<?php
/**
 * Настройки модуля #MODULENAME#
 *
 * @author  Sergey Greznov s.greznov@efusion.ru
 * @since   14/01/2013
 *
 * @link    http://www.efusion.ru/
 */

/**
 * Идентификатор модуля
 */
$sModuleId  = 'blank';

/**
 * Подключаем модуль (выполняем код в файле include.php)
 */
CModule::IncludeModule($sModuleId);

/**
 * Языковые константы (файл lang/ru/options.php)
 */
global $MESS;
IncludeModuleLangFile( __FILE__ );

if( $REQUEST_METHOD == 'POST' && $_POST['Update'] == 'Y' ) {

	/**
     * Если форма была сохранена, устанавливаем значение опции модуля
     */

	COption::SetOptionInt( $sModuleId, 'ACTIVE',($_POST['active'])?1:0);
    COption::SetOptionString( $sModuleId, 'USER_PATH', trim($_POST['USER_PATH']));

    //COption::SetOptionInt( $sModuleId, 'TIME_LIMIT', trim($_POST['time']));
}

/**
 * Описываем табы административной панели битрикса
 */
$aTabs = array(
    array(
        'DIV'   => 'edit1',
        'TAB'   => GetMessage('MAIN_TAB_SET'),
        'ICON'  => 'fileman_settings',
        'TITLE' => GetMessage('MAIN_TAB_TITLE_SET' )
    )
);

/**
 * Инициализируем табы
 */
$oTabControl = new CAdmintabControl( 'tabControl', $aTabs );
$oTabControl->Begin();

/**
 * Ниже пошла форма страницы с настройками модуля
 */
?><form method="POST" enctype="multipart/form-data" action="<?echo $APPLICATION->GetCurPage()?>?mid=<?=htmlspecialchars($sModuleId)?>&lang=<?echo LANG?>">
    <?=bitrix_sessid_post()?>
	<?$oTabControl->BeginNextTab();?>
	<tr class="heading">
        <td colspan="2"><?=GetMessage( 'AUTO_INFO' )?></td>
    </tr>
	<tr>
		<td><label for="active"><?echo GetMessage("DD_BM_LABEL")?></label></td>
		<td><input type="checkbox" name="active" id="active" <?=(COption::GetOptionInt($sModuleId, "ACTIVE", "1"))?'checked':''?> value="Y">
		</td>
	</tr>
	<?//$oTabControl->BeginNextTab();?>

    <?$oTabControl->Buttons();?>
    <input type="submit" name="Update" value="<?=GetMessage( 'DD_BM_BUTTON_SAVE' )?>" />
    <input type="reset" name="reset" value="<?= GetMessage( 'DD_BM_BUTTON_RESET' )?>" />
    <input type="hidden" name="Update" value="Y" />
    <?$oTabControl->End();?>
</form>