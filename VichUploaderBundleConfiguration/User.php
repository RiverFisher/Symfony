<?php

namespace Management\AdminBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Misd\PhoneNumberBundle\Validator\Constraints\PhoneNumber as AssertPhoneNumber;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 *
 * @UniqueEntity("email")
 * @Vich\Uploadable
 */
class User extends BaseUser {
    /**
     * @var integer
     */
    protected $vkontakte_id;

    /**
     * @var integer
     */
    protected $odnoklassniki_id;

    /**
     * @var string
     */
    protected $vkontakte_access_token;

    /**
     * @var string
     */
    protected $odnoklassniki_access_token;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $profileImageName;

    /**
     * @Vich\UploadableField(mapping="profile_image", fileNameProperty="profileImageName")
     * @var File
     */
    private $profileImageFile;

    /**
     * @var string
     */
    private $sex;

    /**
     * @var \DateTime
     */
    private $dateOfBirth;

    /**
     * Assert\Length(
     *      min = 11,
     *      max = 16,
     *      minMessage = "Количество символов в номере телефона должно быть не менее 11",
     *      maxMessage = "Количество символов в номере телефона не должно превышать 16"
     * )
     * Регулярное выражение взято здесь
     * http://mattweb.ru/moj-blog/raznoe/item/142-30-primerov-regulyarnykh-vyrazhenij
     * Также полезно
     * https://ru.stackoverflow.com/questions/107021/Шаблон-для-номера-телефона
     * http://articles-hosting.ru/24/regulyarnoe-vyrazhenie-dlya-validacii-nomera-telefona.html
     *
     * @Assert\Regex(
     *     pattern="/^([+]?[0-9\s-\(\)]{3,25})*$/i",
     *     message="Номер введён в некорректном формате")
     * @var string
     */
    private $phoneNumber;

    /**
     * @var integer
     */
    private $aWeekdaysFrom;

    /**
     * @var integer
     */
    private $aWeekdaysTo;

    /**
     * @var integer
     */
    private $aWeekendFrom;

    /**
     * @var integer
     */
    private $aWeekendTo;

    /**
     * @var integer
     */
    private $points;

    /**
     * @var string
     */
    private $percentageRatio;

    /**
     * @var integer
     */
    private $numberOfGames;

    /**
     * @var integer
     */
    private $experience;

    /**
     * @var string
     */
    private $tennisClub;

    /**
     * @var string
     */
    private $briefInfo;

    /**
     * @var \DateTime
     */
    private $dateOfCreation;

    /**
     * @var \DateTime
     */
    private $dateOfChange;

    /**
     * @var \Geo\LocationBundle\Entity\City
     */
    private $city;

    /**
     * @var \SocialNetwork\TournamentsBundle\Entity\SkillLevel
     */
    private $skillLevel;

    /**
     * Set vkontakteId
     *
     * @param integer $vkontakteId
     *
     * @return User
     */
    public function setVkontakteId($vkontakteId)
    {
        $this->vkontakte_id = $vkontakteId;

        return $this;
    }

    /**
     * Get vkontakteId
     *
     * @return integer
     */
    public function getVkontakteId()
    {
        return $this->vkontakte_id;
    }

    /**
     * Set odnoklassnikiId
     *
     * @param integer $odnoklassnikiId
     *
     * @return User
     */
    public function setOdnoklassnikiId($odnoklassnikiId)
    {
        $this->odnoklassniki_id = $odnoklassnikiId;

        return $this;
    }

    /**
     * Get odnoklassnikiId
     *
     * @return integer
     */
    public function getOdnoklassnikiId()
    {
        return $this->odnoklassniki_id;
    }

    /**
     * Set vkontakteAccessToken
     *
     * @param string $vkontakteAccessToken
     *
     * @return User
     */
    public function setVkontakteAccessToken($vkontakteAccessToken)
    {
        $this->vkontakte_access_token = $vkontakteAccessToken;

        return $this;
    }

    /**
     * Get vkontakteAccessToken
     *
     * @return string
     */
    public function getVkontakteAccessToken()
    {
        return $this->vkontakte_access_token;
    }

    /**
     * Set odnoklassnikiAccessToken
     *
     * @param string $odnoklassnikiAccessToken
     *
     * @return User
     */
    public function setOdnoklassnikiAccessToken($odnoklassnikiAccessToken)
    {
        $this->odnoklassniki_access_token = $odnoklassnikiAccessToken;

        return $this;
    }

    /**
     * Get odnoklassnikiAccessToken
     *
     * @return string
     */
    public function getOdnoklassnikiAccessToken()
    {
        return $this->odnoklassniki_access_token;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set sex
     *
     * @param string $sex
     *
     * @return User
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set dateOfBirth
     *
     * @param \DateTime $dateOfBirth
     *
     * @return User
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get dateOfBirth
     *
     * @return \DateTime
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return User
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set aWeekdaysFrom
     *
     * @param integer $aWeekdaysFrom
     *
     * @return User
     */
    public function setAWeekdaysFrom($aWeekdaysFrom)
    {
        $this->aWeekdaysFrom = $aWeekdaysFrom;

        return $this;
    }

    /**
     * Get aWeekdaysFrom
     *
     * @return integer
     */
    public function getAWeekdaysFrom()
    {
        return $this->aWeekdaysFrom;
    }

    /**
     * Set aWeekdaysTo
     *
     * @param integer $aWeekdaysTo
     *
     * @return User
     */
    public function setAWeekdaysTo($aWeekdaysTo)
    {
        $this->aWeekdaysTo = $aWeekdaysTo;

        return $this;
    }

    /**
     * Get aWeekdaysTo
     *
     * @return integer
     */
    public function getAWeekdaysTo()
    {
        return $this->aWeekdaysTo;
    }

    /**
     * Set aWeekendFrom
     *
     * @param integer $aWeekendFrom
     *
     * @return User
     */
    public function setAWeekendFrom($aWeekendFrom)
    {
        $this->aWeekendFrom = $aWeekendFrom;

        return $this;
    }

    /**
     * Get aWeekendFrom
     *
     * @return integer
     */
    public function getAWeekendFrom()
    {
        return $this->aWeekendFrom;
    }

    /**
     * Set aWeekendTo
     *
     * @param integer $aWeekendTo
     *
     * @return User
     */
    public function setAWeekendTo($aWeekendTo)
    {
        $this->aWeekendTo = $aWeekendTo;

        return $this;
    }

    /**
     * Get aWeekendTo
     *
     * @return integer
     */
    public function getAWeekendTo()
    {
        return $this->aWeekendTo;
    }

    /**
     * Set points
     *
     * @param integer $points
     *
     * @return User
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return integer
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set percentageRatio
     *
     * @param string $percentageRatio
     *
     * @return User
     */
    public function setPercentageRatio($percentageRatio)
    {
        $this->percentageRatio = $percentageRatio;

        return $this;
    }

    /**
     * Get percentageRatio
     *
     * @return string
     */
    public function getPercentageRatio()
    {
        return $this->percentageRatio;
    }

    /**
     * Set numberOfGames
     *
     * @param integer $numberOfGames
     *
     * @return User
     */
    public function setNumberOfGames($numberOfGames)
    {
        $this->numberOfGames = $numberOfGames;

        return $this;
    }

    /**
     * Get numberOfGames
     *
     * @return integer
     */
    public function getNumberOfGames()
    {
        return $this->numberOfGames;
    }

    /**
     * Set experience
     *
     * @param integer $experience
     *
     * @return User
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * Get experience
     *
     * @return integer
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * Set tennisClub
     *
     * @param string $tennisClub
     *
     * @return User
     */
    public function setTennisClub($tennisClub)
    {
        $this->tennisClub = $tennisClub;

        return $this;
    }

    /**
     * Get tennisClub
     *
     * @return string
     */
    public function getTennisClub()
    {
        return $this->tennisClub;
    }

    /**
     * Set briefInfo
     *
     * @param string $briefInfo
     *
     * @return User
     */
    public function setBriefInfo($briefInfo)
    {
        $this->briefInfo = $briefInfo;

        return $this;
    }

    /**
     * Get briefInfo
     *
     * @return string
     */
    public function getBriefInfo()
    {
        return $this->briefInfo;
    }

    /**
     * Set dateOfCreation
     *
     * @param \DateTime $dateOfCreation
     *
     * @return User
     */
    public function setDateOfCreation($dateOfCreation)
    {
        $this->dateOfCreation = $dateOfCreation;

        return $this;
    }

    /**
     * Get dateOfCreation
     *
     * @return \DateTime
     */
    public function getDateOfCreation()
    {
        return $this->dateOfCreation;
    }

    /**
     * Set dateOfChange
     *
     * @param \DateTime $dateOfChange
     *
     * @return User
     */
    public function setDateOfChange($dateOfChange)
    {
        $this->dateOfChange = $dateOfChange;

        return $this;
    }

    /**
     * Get dateOfChange
     *
     * @return \DateTime
     */
    public function getDateOfChange()
    {
        return $this->dateOfChange;
    }

    /**
     * Set city
     *
     * @param \Geo\LocationBundle\Entity\City $city
     *
     * @return User
     */
    public function setCity(\Geo\LocationBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \Geo\LocationBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set skillLevel
     *
     * @param \SocialNetwork\TournamentsBundle\Entity\SkillLevel $skillLevel
     *
     * @return User
     */
    public function setSkillLevel(\SocialNetwork\TournamentsBundle\Entity\SkillLevel $skillLevel = null)
    {
        $this->skillLevel = $skillLevel;

        return $this;
    }

    /**
     * Get skillLevel
     *
     * @return \SocialNetwork\TournamentsBundle\Entity\SkillLevel
     */
    public function getSkillLevel()
    {
        return $this->skillLevel;
    }

    /**
     * Set profileImage
     *
     * @param string $profileImageName
     *
     * @return User
     */
    public function setProfileImageName($profileImageName)
    {
        $this->profileImageName = $profileImageName;

        return $this;
    }

    /**
     * Get profileImage
     *
     * @return string
     */
    public function getProfileImageName()
    {
        return $this->profileImageName;
    }

    /**
     * @param File|null $image
     */
    public function setProfileImageFile(File $image = null)
    {
        $this->profileImageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'dateOfChange' is not defined in your entity, use another property
            $this->dateOfChange = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getProfileImageFile()
    {
        return $this->profileImageFile;
    }
}
