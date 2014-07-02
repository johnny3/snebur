<?php

namespace LFSM\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use LFSM\ToolBundle\Entity\Tools;
use LFSM\DonateurBundle\Entity\Donateur;

/**
 * Picture
 *
 * @ORM\Table(name="excel_file_import")
 * @ORM\Entity(repositoryClass="LFSM\AdminBundle\Repository\ExcelFileImportRepository")
 */
class ExcelFileImport
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255, nullable=false)
     */
    private $filename;

    /**
     * @Assert\File(maxSize="10M")
     */
    public $file;

    public function __toString()
    {
        return $this->filename;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function getWebPath()
    {
        return null === $this->file ? null : $this->getUploadDir() . '/' . $this->file;
    }

    protected function getUploadRootDir()
    {
        return __DIR__ . '/../../../../data/' . $this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/csv';
    }

    public function uploadFile()
    {
        $this->file->move($this->getUploadRootDir(), str_replace(' ', '_', $this->file->getClientOriginalName()));
        $this->filename = str_replace(' ', '_', $this->file->getClientOriginalName());
        $this->file = null;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ExcelFileImport
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return ExcelFileImport
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return ExcelFileImport
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    public static function extractFilenameWithoutExtension($filename)
    {
        $buffer = explode(".", $filename);

        return $buffer[0];
    }

    /**
     * Get dynamic excel file name.
     *
     * @return path to the excel file
     */
    public function getExcelFilename($em)
    {
        $excelFile = $em->getRepository('LFSMAdminBundle:ExcelFileImport')->find(1);
        $filename = "";

        if ($excelFile)
        {
            $filename = $excelFile->getFilename();

            if (empty($filename))
            {
                throw new \UnexpectedValueException('Ce fichier n\'existe pas. Uploadez le s\'il vous plait.');
            }
        }

        return $filename;
    }

    /**
     * Get dynamic excel file name.
     *
     * @return path to the excel file
     */
    public function getPathExcelFile($em, $rootDir)
    {
        $filename = $this->getExcelFilename($em);

        if ($filename)
        {
            $excelFilePath = $rootDir . '/data/' . $this->getUploadDir() . '/' . $filename;

            if (empty($filename) || !file_exists($excelFilePath))
            {
                throw new \UnexpectedValueException('Ce fichier n\'existe pas. Uploadez le s\'il vous plait.');
            }
        }

        return $excelFilePath;
    }

    /**
     * Initialize phpexcel declaration and convert excel file into csv file
     *
     * @return $csvFilePath
     */
    public function initializeExcelSheet($em, $rootDir)
    {
        $infile = $this->getPathExcelFile($em, $rootDir);
        $filenameWithoutExtension = self::extractFilenameWithoutExtension($this->getExcelFilename($em));

        $fileType = \PHPExcel_IOFactory::identify($infile);
        $objReader = \PHPExcel_IOFactory::createReader($fileType);

        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($infile);
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');

        $csvFilePath = $rootDir . '/data/uploads/csv/' . $filenameWithoutExtension . '.csv';

        $objWriter->save($csvFilePath);

        return $csvFilePath;
    }

    public function parseExcelFileHeader($em, $rootDir)
    {
        $objPHPExcel = $this->initializeExcelSheet($em, $rootDir);

        $a_headers = Tools::parse_csv_file_headers($objPHPExcel, true, ",");

        $a_values = array();

        foreach ($a_headers as $s_header)
        {
            $a_values[$s_header] = $s_header;
        }

        return $a_values;
    }

    public function getCsvFilenamePath($em, $rootDir)
    {
        $filenameWithoutExtension = self::extractFilenameWithoutExtension($this->getExcelFilename($em));

        return $rootDir . '/data/uploads/csv/' . $filenameWithoutExtension . '.csv';
    }
    
    /**
     * On traite si les valeurs pour chaque champ sont du bon type
     * @param type $a_donateur
     * @param type $session
     * @return boolean
     */
    public static function areValidValues($a_donateur, $session){
        $return = true;
          
        return $return;
    }
    
    public static function mandatoryFields(){
        return array(
            'civilite' => 'Civilité',
            'nom' => 'Nom',
            'prenom' => 'Prénom',
            'adresse' => 'Adresse',
            'cp' => 'Code Postal',
            'ville' => 'Ville',
            'birthday' => 'Date Anniversaire'
        );
    }
    
    public static function checkMappingDatas($a_mapped_values){
        $a_data_error = array();
        $a_mandatoryFields = self::mandatoryFields();
        
        if (empty($a_mapped_values)){
            return false;
        }
        else {
            foreach ($a_mapped_values as $key => $value){
                if (in_array($key, array_keys($a_mandatoryFields)) && '' == $value){
                    $a_data_error[] = $a_mandatoryFields[$key];
                }
            }
        }
        
        return $a_data_error;
    }
    
    public static function cleanData($valuesArray){
        foreach($valuesArray as $key => $value){
            if (empty($value)){
                unset($valuesArray[$key]);
            }
        }
        
        return array_flip($valuesArray);
    }

    public function insertValuesIntoDatabase($em, $a_data, $session)
    {
        $donateurRejected = array();
        $amountOfValidatedDonators = 0;
        
        foreach ($a_data as $key => $a_donateur){
            $b_isValidDonateur = self::areValidValues($a_donateur, $session);

            if ($b_isValidDonateur)
            {
                $o_donateur = new Donateur();
                ksort($a_donateur);

                foreach ($a_donateur as $key => $value){
                    if ('nom' === $key){
                       $o_donateur->setNom($value);
                    }
                    elseif ('prenom' === $key){
                        $o_donateur->setPrenom($value);
                    }

                    elseif ('telPrm' === $key && ' ' !== $value){
                        $o_donateur->setTelPrm($value);
                    }

                    elseif ('telSec' === $key && ' ' !== $value){
                        $o_donateur->setTelSec($value);
                    }

                    elseif ('email' === $key && ' ' !== $value){
                        $o_donateur->setEmail($value);
                    }
                    
                    elseif ('cp' === $key){
                        $o_donateur->setCp($value);
                    }
                    
                    elseif ('birthday' === $key){
                        $o_donateur->setBirthday($value);
                    }
                    
                    elseif ('ville' === $key){
                        $o_donateur->setVille($value);
                    }
                }
                
                $em->persist($o_donateur);
                $amountOfValidatedDonators++;
                unset($o_donateur);
            }
            else {
                $session->getFlashBag()->add('error', 'Le donateur de la ligne ' . $o_donateur->getNom() . ' ' . $o_donateur->getPrenom() . 'a été rejeté');
            }
        }
        
        if ($amountOfValidatedDonators > 0)
        {
            return true;
        }

        return false;
               
    }
}
