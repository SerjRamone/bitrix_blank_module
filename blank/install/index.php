<?php
/**
 * Инсталляция модуля serjramon
 *
 * @author  Sergey Greznov
 * @since   14/01/2013
 *
 * @link    http://www.efusion.ru/
 */

/**
 * Подключаем языковые константы
 */
global $MESS;
$strPath2Lang = str_replace("\\", "/", __FILE__);
$strPath2Lang = substr($strPath2Lang, 0, strlen($strPath2Lang) - 18);
@include(GetLangFileName($strPath2Lang . "/lang/", "/install/index.php"));
IncludeModuleLangFile($strPath2Lang . "/install/index.php");

class blank extends CModule {

	public $MODULE_ID = 'blank';
	public $MODULE_VERSION = '1.0.0';
	public $MODULE_VERSION_DATE = '2013-01-14 09:00:00';
	public $MODULE_NAME;
	public $MODULE_DESCRIPTION;

	/**
	 * Инициализация модуля для страницы "Управление модулями"
	 */
	public function blank() {
		$this -> MODULE_NAME = GetMessage('AUTHORIZE_BM_MODULE_NAME');
		$this -> MODULE_DESCRIPTION = GetMessage('AUTHORIZE_BM_MODULE_DESC');
	}

	/**
	 * Устанавливаем модуль
	 */
	public function DoInstall() {
		if (!$this -> InstallDB() || !$this -> InstallEvents() || !$this -> InstallFiles() || !$this -> InstallIblocks()) {
			return;
		}

		RegisterModule($this -> MODULE_ID);
	}

	/**
	 * Удаляем модуль
	 */
	public function DoUninstall() {
		if (!$this -> UnInstallDB() || !$this -> UnInstallEvents() || !$this -> UnInstallFiles() || !$this -> UnInstallIblocks()) {
			return;
		}
		UnRegisterModule($this -> MODULE_ID);
	}

	/**
	 * Добавляем инфоблоки
	 *
	 * @return bool
	 */
	public function InstallIblocks() {

			return true;
	}

	/**
	 * Удаляем инфоблоки
	 *
	 * @return bool
	 */
	public function UnInstallIblocks() {
		return true;
	}

	/**
	 * Добавляем почтовые события
	 *
	 * @return bool
	 */
	public function InstallEvents() {
		return true;
	}

	/**
	 * Удаляем почтовые события
	 *
	 * @return bool
	 */
	public function UnInstallEvents() {
		return true;
	}

	/**
	 * Копируем файлы административной части
	 *
	 * @return bool
	 */
	public function InstallFiles() {

		#CopyDirFiles($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/" . $this -> MODULE_ID . "/install/components/fusion", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/components/fusion", true, true);
		return true;
	}

	/**
	 * Удаляем файлы административной части
	 *
	 * @return bool
	 */
	public function UnInstallFiles() {
		#CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/components/fusion",$_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/components/fusion",true,true);
		return true;
	}

	/**
	 * Добавляем таблицы в БД
	 *
	 * @return bool
	 */
	public function InstallDB() {

		global $DB;


		return true;
	}

	/**
	 * Удаляем таблицы из БД
	 *
	 * @return bool
	 */
	public function UnInstallDB() {

		global $DB;

		return true;
	}
}
?>