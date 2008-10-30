<?
require_once(dirname(__FILE__)."/../../globals.php");

abstract class GenericParser
{
	
	/**
	 * Notifes all functions that are subscribed to the new
	 * raid event.
	 * 
	 * @param String $zone The name of the raid zone.
	 * @param int $date A unix timestamp indicating the date
	 * of the raid.
	 * @param int $starttime A unix timestamp indicating the
	 * time the raid started.
	 * @param int $endtime A unix timestamp indicating the time
	 * the raid ended.
	 */
	protected function notifyNewRaid($zone, $date, $starttime, $endtime) {
		if (count($dkpHooks['newraid']) > 0) {
			foreach($dkpHooks['newraid'] as $newRaidFunc) {
				if (function_exists($newRaidFunc)) {
					call_user_func_array($newRaidFunc, func_get_args());
				}
			}
		}
	}
	
	/**
	 * Notifies all functions that are subscribed to the new
	 * attendee event.
	 * 
	 * @param String $attendee This is the name of the attendee.
	 */
	protected function notifyNewAttendee($attendee) {
		if (count($dkpHooks['newattendee']) > 0) {
			foreach($dkpHooks['newattendee'] as $newAttendeeFunc) {
				if (function_exists($newAttendeeFunc)) {
					call_user_func_array($newAttendeeFunc, func_get_args());
				}
			}
		}
	}
	
	/**
	 * Notifies all functions that are suscribed to the boss
	 * kill event.
	 * 
	 * @param String $boss This is the name of the boss that
	 * has been killed.
	 */
	protected function notifyBossKill($boss) {
		if (count($dkpHooks['bosskill']) > 0) {
			foreach($dkpHooks['bosskill'] as $bossKillFunc) {
				if (function_exists($bossKillFunc)) {
					call_user_func_array($bossKillFunc, func_get_args());
				}
			}
		}
	}
	
	/**
	 * Notifies all functions that are subscribed to the dkp
	 * awarded event.
	 * 
	 * @param string $player The name of the player the dkp
	 * is awarded to.
	 * @param float $amount The amount of dkp awarded.
	 */
	protected function notifyDkpAwarded($player, $amount) {
		if (count($dkpHooks['dkpawarded']) > 0) {
			foreach($dkpHooks['dkpawarded'] as $dkpAwardedFunc) {
				if (function_exists($dkpAwardedFunc)) {
					call_user_func_array($dkpAwardedFunc, func_get_args());
				}
			}
		}
	}	
	
	/**
	 * Notifies all functions that are subscribed to the dkp
	 * deducted event.
	 * 
	 * @param string $player The name of the player the dkp
	 * is being deducted from.
	 * @param float $amount The amount of dkp beind deducted.
	 */
	protected function notifyDkpDeducted($player, $amount) {
		if (count($dkpHooks['dkpdeducted']) > 0) {
			foreach($dkpHooks['dkpdeducted'] as $dkpDeductedFunc) {
				if (function_exists($dkpDeductedFunc)) {
					call_user_func_array($dkpDeductedFunc, func_get_args());
				}
			}
		}
	}
	
	/**
	 * Notifies all functions that are subscribed to the dkp
	 * spent event.
	 * 
	 * @param string $player The player who has spent dkp.
	 * @param string $item The name of the item the player
	 * has purchased.
	 */
	protected function notifyDkpSpent($player, $item) {
		if (count($dkpHooks['dkpspent']) > 0) {
			foreach($dkpHooks['dkpspent'] as $dkpSpentFunc) {
				if (function_exists($dkpSpentFunc)) {
					call_user_func_array($dkpSpentFunc, func_get_args());
				}
			}
		}
	}
}
?>