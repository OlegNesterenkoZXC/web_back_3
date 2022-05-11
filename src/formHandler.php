<?php

class formHandler
{
	public static function checkUserData(UserData $user): array
	{
		$errors["requestError"] = false;

		if (empty($user->getName())) {
			$errors['name'] = "Введите имя!";
		} elseif (!preg_match("/^\s*[a-zA-Zа-яА-Я'][a-zA-Zа-яА-Я-' ]+[a-zA-Zа-яА-Я']?\s*$/u", $user->getName())) {
			$errors['name'] = "Несуществующее имя!";
		}

		if (empty($user->getEmail())) {
			$errors['email'] = "Введите e-mail!";
		} elseif (!preg_match("/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/", $user->getEmail())) {
			$errors['email'] = "Несуществующий e-mail!";
		}

		if (empty($user->getYear())) {
			$errors['year'] = "Выберите год!";
		} elseif (!preg_match("/^\s*[1]{1}9{1}\d{1}\d{1}.*$|^\s*200[0-8]{1}.*$/", $user->getYear())) {
			$errors["requestError"] = true;
		}

		if (empty($user->getGender())) {
			$errors['gender'] = "Выберите пол!";
		} elseif (intval($user->getGender()) < 1 && 2 < intval($user->getGender())) {
			$errors["requestError"] = true;
		}

		if (empty($user->getNumlimbs())) {
			$errors['numlimbs'] = "Выберите кол-во конечностей!";
		} elseif (intval($user->getNumlimbs()) < 1 || 4 < intval($user->getNumlimbs())) {
			$errors["requestError"] = true;
		}

		if (empty($user->getSuperPowers())) {
			$errors['super-powers'] = "Выберите хотя бы одну суперспособность!";
		} else {
			foreach ($user->getSuperPowers() as $value) {
				if (intval($value) < 1 || 3 < intval($value)) {
					$errors["requestError"] = true;
					break;
				}
			}
		}

		if (empty($user->getBiography())) {
			$errors['biography'] = "Расскажите что-нибудь о себе!";
		}

		return $errors;
	}
}
