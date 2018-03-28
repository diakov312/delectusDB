<?php

//Класс модели.Логика работы с главной страницей.
class Model_Main
{
    //метод получения данных при первоначальном формировании главной страницы
    public function getDataMainPage() {
        $pdo = new PDO(DSN, DB_USERNAME,DB_PASSWORD);
        $dataCountries = $pdo
            ->query("SELECT DISTINCT name_country AS countryName FROM country")
            ->fetchAll(PDO::FETCH_COLUMN);
        $dataCities = $pdo
            ->query("SELECT DISTINCT name_city AS cityName FROM cities")
            ->fetchAll(PDO::FETCH_COLUMN);
        $dataOrganization = $pdo
            ->query("SELECT DISTINCT name_organization AS organizationName FROM organization")
            ->fetchAll(PDO::FETCH_COLUMN);
        $data = array("Countries" => $dataCountries, "Cities" => $dataCities, "Organization" => $dataOrganization);
        return $data;
    }

    //метод возвращающий данные при изменении полей фильтра (Страны, города, организации, адреса)
    public function getDataChangesFilter () {
        $pdo = new PDO(DSN, DB_USERNAME,DB_PASSWORD);
        $varOperait = "WHERE";
        // Формируем основные запросы к базе данных
        $tempQueryCountries = "SELECT DISTINCT name_country FROM country co "
            ."LEFT JOIN cities ci ON co.id_country=ci.id_country "
            ."LEFT JOIN organization org ON ci.id_city=org.id_city";
        $tempQueryCities = "SELECT DISTINCT name_city FROM cities ci "
            ."LEFT JOIN country co ON ci.id_country=co.id_country "
            ."LEFT JOIN organization org ON ci.id_city=org.id_city";
        $tempQueryOrganizations = "SELECT DISTINCT name_organization FROM organization org "
            ."LEFT JOIN cities ci ON org.id_city=ci.id_city "
            ."LEFT JOIN country co ON ci.id_country=co.id_country";
        $tempQueryAdresses = "SELECT id_address, value_address, name_organization, name_city, name_country FROM address_organization ad "
            ."JOIN organization org ON ad.id_organization=org.id_organization "
            ."JOIN cities ci ON org.id_city=ci.id_city "
            ."JOIN country co ON ci.id_country=co.id_country";

        //Выполяем проверку на заполненность полей корректируем запрос к базе данных
        if (!empty($_POST[countrySelect]) && ($_POST[countrySelect] !== "")) {
            $tempQueryCountries = $tempQueryCountries." ".$varOperait." name_country=:countrySelect";
            $tempQueryCities = $tempQueryCities." ".$varOperait." name_country=:countrySelect";
            $tempQueryOrganizations = $tempQueryOrganizations." ".$varOperait." name_country=:countrySelect";
            $tempQueryAdresses = $tempQueryAdresses." ".$varOperait." name_country=:countrySelect";
            $varOperait = "AND";
        }
        if (!empty($_POST[citySelect]) && ($_POST[citySelect] !== "")) {
            $tempQueryCountries = $tempQueryCountries." ".$varOperait." name_city=:citySelect";
            $tempQueryCities = $tempQueryCities." ".$varOperait." name_city=:citySelect";
            $tempQueryOrganizations = $tempQueryOrganizations." ".$varOperait." name_city=:citySelect";
            $tempQueryAdresses = $tempQueryAdresses." ".$varOperait." name_city=:citySelect";
            $varOperait = "AND";
        }
        if (!empty($_POST[organizationSelect]) && ($_POST[organizationSelect] !== "")) {
            $tempQueryCountries = $tempQueryCountries." ".$varOperait." name_organization=:organizationSelect";
            $tempQueryCities = $tempQueryCities." ".$varOperait." name_organization=:organizationSelect";
            $tempQueryOrganizations = $tempQueryOrganizations." ".$varOperait." name_organization=:organizationSelect";
            $tempQueryAdresses = $tempQueryAdresses." ".$varOperait." name_organization=:organizationSelect";
        }

        $queryCountries = $pdo->prepare($tempQueryCountries);
        $queryCities = $pdo->prepare($tempQueryCities);
        $queryOrganization = $pdo->prepare($tempQueryOrganizations);
        $queryAddresses = $pdo->prepare($tempQueryAdresses);

        //Подставляем выбранные значения в свормированный запрос
        if (!empty($_POST[countrySelect]) && ($_POST[countrySelect] !== "")) {
            $queryCountries->bindParam(":countrySelect", $_POST[countrySelect]);
            $queryCities->bindParam(":countrySelect", $_POST[countrySelect]);
            $queryOrganization->bindParam(":countrySelect", $_POST[countrySelect]);
            $queryAddresses->bindParam(":countrySelect", $_POST[countrySelect]);
        }
        if (!empty($_POST[citySelect]) && ($_POST[citySelect] !== "")) {
            $queryCountries->bindParam(":citySelect", $_POST[citySelect]);
            $queryCities->bindParam(":citySelect", $_POST[citySelect]);
            $queryOrganization->bindParam(":citySelect", $_POST[citySelect]);
            $queryAddresses->bindParam(":citySelect", $_POST[citySelect]);
        }
        if (!empty($_POST[organizationSelect]) && ($_POST[organizationSelect] !== "")) {
            $queryCountries->bindParam(":organizationSelect", $_POST[organizationSelect]);
            $queryCities->bindParam(":organizationSelect", $_POST[organizationSelect]);
            $queryOrganization->bindParam(":organizationSelect", $_POST[organizationSelect]);
            $queryAddresses->bindParam(":organizationSelect", $_POST[organizationSelect]);
        }

        $queryCountries->execute();
        $queryCities->execute();
        $queryOrganization->execute();
        $queryAddresses->execute();

        $dataCountries = $queryCountries->fetchAll(PDO::FETCH_COLUMN); //Массив строк
        $dataCities = $queryCities->fetchAll(PDO::FETCH_COLUMN);    //Массив строк
        $dataOrganizations = $queryOrganization->fetchAll(PDO::FETCH_COLUMN);   //Массив строк
        $dataAdresses = $queryAddresses->fetchAll(PDO::FETCH_OBJ);  //Массив объектов

        //формируем массив данных для вывода
        $data = array("Countries" => $dataCountries, "Cities" => $dataCities,
            "Organization" => $dataOrganizations, "Addresses" => $dataAdresses);
        return $data;
    }

    //Метод добавления страны с главной страницы
    public function addCountry() {
        $pdo = new PDO(DSN, DB_USERNAME,DB_PASSWORD);
        $queryCheckCountry = $pdo->prepare("SELECT name_country FROM country WHERE name_country=:countryName");
        $queryCheckCountry->bindParam(":countryName", $_POST[countrySelect]);
        $queryCheckCountry->execute();
        $resultShareCountry = $queryCheckCountry->fetch(PDO::FETCH_COLUMN);

        if($resultShareCountry == false) {
            $queryInsertCountry = $pdo->prepare("INSERT INTO country (name_country) VALUES (:countryName)");
            $queryInsertCountry->bindParam(":countryName", $_POST[countrySelect]);
            $queryInsertCountry->execute();
            $resultShareCountry = "CountryAdded";
        }
        return $resultShareCountry;
    }

    //Метод добавления города с главной страницы
    public function addCity() {
        $pdo = new PDO(DSN, DB_USERNAME,DB_PASSWORD);
        $queryCheckCountry = $pdo->prepare("SELECT name_country, id_country AS idCountry FROM country WHERE name_country=:countryName");
        $queryCheckCountry->bindParam(":countryName", $_POST[countrySelect]);
        $queryCheckCountry->execute();
        $resultShareCountry = $queryCheckCountry->fetch(PDO::FETCH_OBJ);

        if($resultShareCountry == false) {
            $resultCheck = "CountryNotInDB";
        } else {
            $queryCheckCity = $pdo->prepare("SELECT name_city FROM cities ci"
                ." JOIN country co ON ci.id_country=co.id_country"
                ." WHERE name_city=:cityName"
                ." AND name_country=:countryName");
            $queryCheckCity->bindParam(":cityName", $_POST[citySelect]);
            $queryCheckCity->bindParam(":countryName", $_POST[countrySelect]);
            $queryCheckCity->execute();
            $resultShareCity = $queryCheckCity->fetch(PDO::FETCH_COLUMN);

            if ($resultShareCity === false) {
                $queryInsertCity = $pdo->prepare("INSERT INTO cities (name_city, id_country)"
                    ." VALUES (:cityName, :countryId)");
                $queryInsertCity->bindParam(":cityName", $_POST[citySelect]);
                $queryInsertCity->bindParam(":countryId", $resultShareCountry->idCountry);
                $queryInsertCity->execute();
                $resultCheck = "CityAdded";
            } else {
                $resultCheck = "CityInDB";
            }
        }
        return $resultCheck;
    }

    //Метод добавления организации с главной страницы
    public function addOrganization() {
        $pdo = new PDO(DSN, DB_USERNAME,DB_PASSWORD);
        $queryCheckCountry = $pdo->prepare("SELECT name_country FROM country WHERE name_country=:countryName");
        $queryCheckCountry->bindParam(":countryName", $_POST[countrySelect]);
        $queryCheckCountry->execute();
        $resultShareCountry = $queryCheckCountry->fetch(PDO::FETCH_COLUMN);

        if ($resultShareCountry == false) {
            $resultCheck = "CountryNotInDB";
        } else {
            $queryCheckCity = $pdo->prepare("SELECT id_city AS cityId, name_city FROM cities ci"
                ." JOIN country co ON ci.id_country=co.id_country"
                ." WHERE name_city=:cityName"
                ." AND name_country=:countryName");
            $queryCheckCity->bindParam(":cityName", $_POST[citySelect]);
            $queryCheckCity->bindParam(":countryName", $_POST[countrySelect]);
            $queryCheckCity->execute();
            $resultShareCity = $queryCheckCity->fetch(PDO::FETCH_OBJ);

            if ($resultShareCity == false) {
                $resultCheck = "CityNotInDB";
            } else {
                $queryCheckOrganization = $pdo->prepare("SELECT name_organization FROM organization org"
                    ." JOIN cities ci ON org.id_city=ci.id_city"
                    ." JOIN country co ON ci.id_country=co.id_country"
                    ." WHERE name_country=:countryName"
                    ." AND name_city=:cityName"
                    ." AND name_organization=:organizationName");
                $queryCheckOrganization->bindParam(":countryName", $_POST[countrySelect]);
                $queryCheckOrganization->bindParam(":cityName", $_POST[citySelect]);
                $queryCheckOrganization->bindParam(":organizationName", $_POST[organizationSelect]);
                $queryCheckOrganization->execute();
                $resultShareOrganization = $queryCheckOrganization->fetch(PDO::FETCH_COLUMN);

                if ($resultShareOrganization == false) {
                    $queryInsertCity = $pdo->prepare("INSERT INTO organization (name_organization, id_city)"
                        ." VALUES (:organizationName, :cityId)");
                    $queryInsertCity->bindParam(":organizationName", $_POST[organizationSelect]);
                    $queryInsertCity->bindParam(":cityId", $resultShareCity->cityId);
                    $queryInsertCity->execute();
                    $resultCheck = "OrganizationAdded";
                } else {
                    $resultCheck = "OrganizationInDB";
                }
            }
        }
        return $resultCheck;
    }

    //Метод добавления адреса с главной страницы
    public function addAddress() {
        $pdo = new PDO(DSN, DB_USERNAME,DB_PASSWORD);
        $queryCheckCountry = $pdo->prepare("SELECT name_country FROM country WHERE name_country=:countryName");
        $queryCheckCountry->bindParam(":countryName", $_POST[countrySelect]);
        $queryCheckCountry->execute();
        $resultShareCountry = $queryCheckCountry->fetch(PDO::FETCH_COLUMN);

        if ($resultShareCountry == false) {
            $resultCheck = "CountryNotInDB";
        } else {
            $queryCheckCity = $pdo->prepare("SELECT name_city FROM cities ci"
                ." JOIN country co ON ci.id_country=co.id_country"
                ." WHERE name_city=:cityName"
                ." AND name_country=:countryName");
            $queryCheckCity->bindParam(":cityName", $_POST[citySelect]);
            $queryCheckCity->bindParam(":countryName", $_POST[countrySelect]);
            $queryCheckCity->execute();
            $resultShareCity = $queryCheckCity->fetch(PDO::FETCH_OBJ);

            if ($resultShareCity == false) {
                $resultCheck = "CityNotInDB";
            } else {
                $queryCheckOrganization = $pdo->prepare("SELECT id_organization AS organizationId, name_organization FROM organization org"
                    ." JOIN cities ci ON org.id_city=ci.id_city"
                    ." JOIN country co ON ci.id_country=co.id_country"
                    ." WHERE name_country=:countryName"
                    ." AND name_city=:cityName"
                    ." AND name_organization=:organizationName");
                $queryCheckOrganization->bindParam(":countryName", $_POST[countrySelect]);
                $queryCheckOrganization->bindParam(":cityName", $_POST[citySelect]);
                $queryCheckOrganization->bindParam(":organizationName", $_POST[organizationSelect]);
                $queryCheckOrganization->execute();
                $resultShareOrganization = $queryCheckOrganization->fetch(PDO::FETCH_OBJ);

                if ($resultShareOrganization == false) {
                    $resultCheck = "OrganizationNotInDB";
                } else {
                    $queryCheckAddress = $pdo->prepare("SELECT value_address FROM address_organization adr"
                        ." JOIN organization org ON adr.id_organization=org.id_organization"
                        ." JOIN cities ci ON org.id_city=ci.id_city"
                        ." JOIN country co ON ci.id_country=co.id_country"
                        ." WHERE name_country=:countryName"
                        ." AND name_city=:cityName"
                        ." AND name_organization=:organizationName"
                        ." AND value_address=:valueAddress");
                    $queryCheckAddress->bindParam(":countryName", $_POST[countrySelect]);
                    $queryCheckAddress->bindParam(":cityName", $_POST[citySelect]);
                    $queryCheckAddress->bindParam(":organizationName", $_POST[organizationSelect]);
                    $queryCheckAddress->bindParam(":valueAddress", $_POST[addressSelect]);
                    $queryCheckAddress->execute();
                    $resultShareAddress = $queryCheckAddress->fetch(PDO::FETCH_COLUMN);

                    if ($resultShareAddress == false) {
                        $queryInsertAddress = $pdo->prepare("INSERT INTO address_organization (value_address, id_organization)"
                            ." VALUES (:valueAddress, :organizationId)");
                        $queryInsertAddress->bindParam(":valueAddress", $_POST[addressSelect]);
                        $queryInsertAddress->bindParam(":organizationId", $resultShareOrganization->organizationId);
                        $queryInsertAddress->execute();
                        $resultCheck = "AddressAdded";
                    } else {
                        $resultCheck = "AddressInDB";
                    }
                }
            }
        }
        return $resultCheck;
    }
}