<?php
    require_once ("conexao.php");
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 13/09/2017
 * Time: 20:23
 */
class plano
{
    private $conexao;
    private $materia;
    private $materia_status;
    private $tempo_parada;
    private $aula_id;
    private $aula   ;
    private $aula_status;
    private $resumo;
    function __construct()
    {
        $this->conexao = conexao::getInstance();
    }

    public function upAula($aula, $resumo)
    {
        $sql = $this->conexao->prepare("UPDATE aulas 
                                           SET aula_status = 2 
                                             , resumo = :res
                                         WHERE id_aula= :id");
        $sql->bindValue(":id" , $aula);
        $sql->bindValue(":res", $resumo);

        $sql->execute();
        if ($sql->rowCount() > 0 )
        {
            return "index.php";
        }
    }

    public function upTempo($texto, $id)
    {
        $sql=$this->conexao->prepare(" UPDATE aulas
                                          SET aula_status = 1
                                            , tempo_parada = :txt
                                        WHERE id_aula= :id ");
        $sql->bindValue(":txt", $texto);
        $sql->bindValue(":id" , $id);
        $sql->execute();

        if ($sql->rowCount() > 0 )
        {
           return "index.php";
        }
    }

    public function turmaAula($aula, $materia){
        $sql = $this->conexao->prepare(" select   a.id_aula
                                                 ,a.aula_nome
                                                 ,a.aula_status
                                                 ,a.tempo_parada
                                                 ,a.resumo
                                                 ,d.nome
                                                 ,d.materia_status
                                                 
                                          from aulas a
                                    inner join disciplinas d on d.id_disciplinas = a.fk_materia
                                         where a.id_aula = :a
                                           and d.id_disciplinas = :m");
        $sql->bindValue(":a",$aula);
        $sql->bindValue(":m",$materia);
        $sql->execute();
        if ($sql->rowCount() > 0)
        {
            while ($lista = $sql->fetch(PDO::FETCH_ASSOC))
            {
                $this->setAulaId        ($lista["id_aula"]);
                $this->setAula          ($lista["aula_nome"]);
                $this->setAulaStatus    ($lista["aula_status"]);
                $this->setTempoParada   ($lista["tempo_parada"]);
                $this->setResumo        ($lista["resumo"]);
                $this->setMateria       ($lista["nome"]);
                $this->setMateriaStatus ($lista["materia_status"]);
            }
        }

    }


    public function materias(){
        $sql = $this->conexao->prepare("select * from disciplinas");
        $sql->execute();
        if ($sql->rowCount() >0)
        {
            $linha = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach ($linha as $listar){
                $r_id_disciplinas     = $listar["id_disciplinas"];
                $r_nome               = $listar["nome"];
                $r_status             = $listar["materia_status"];
                $r_icon               = $listar["icon"];

                echo "<div class='panel panel-default'>
                        <div class='panel-heading'>
                            <h4 class='panel-title'>
                                <a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion2' href='#".$r_id_disciplinas."'>
                                <img src='".$r_icon."'/> $r_nome
                                </a>
                            </h4>
                        </div>
                        <div id='".$r_id_disciplinas."' class='panel-collapse collapse'>
                            <div class='panel-body'>
                            <!--<h3>-->
                               ";
                               $this->aulas($r_id_disciplinas);
                               echo "
                            
                            <!--</h3>-->
                            </div>
                        </div>
                      </div>";

            }
        }
    }

    public function aulas($id_materia){
        $sql = $this->conexao->prepare("select * from aulas a
                                        where a.fk_materia = :id");
        $sql->bindValue(":id", $id_materia);
        $sql->execute();

        if ($sql->rowCount() > 0)
        {
            $linha = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach ($linha as $res)
            {
                $r_id           = $res["id_aula"];
                $r_fk_materia   = $res["fk_materia"];
                $r_aula_nome    = $res["aula_nome"];
                $r_status       = $res["aula_status"];
                $r_tempo        = $res["tempo_parada"];

                 if ($r_status == 0)
                {
                   //echo "<button type='button' class='btn btn-default'>$r_aula_nome</button>";
                   echo "<a href='?turma=".$r_fk_materia."&aula=".$r_id."' class='btn btn-default' role='button'>$r_aula_nome</a>";

                }
                if ($r_status == 1)
                {
                    //echo "<span class='label label-warning'>$r_aula_nome</span>";
                    //echo "<button class='btn btn-warning'>$r_aula_nome</button>";
                    echo "<a href='?turma=".$r_fk_materia."&aula=".$r_id."' class='btn btn-warning' role='button'>$r_aula_nome</a>";
                    //echo "<br>";
                    //echo "<br>";
                }
                if ($r_status == 2)
                {
                    //echo "<span class='label label-success'>$r_aula_nome</span>";
                    //echo "<button class='btn btn-success'>$r_aula_nome</button>";
                    echo "<a href='?turma=".$r_fk_materia."&aula=".$r_id."' class='btn btn-success' role='button'>$r_aula_nome</a>";
                 //   echo "<br>";
                   // echo "<br>";
                }

            }
        }

    }

    /**
     * @param mixed $materia
     */
    public function setMateria($materia)
    {
        $this->materia = $materia;
    }

    /**
     * @param mixed $aula
     */
    public function setAula($aula)
    {
        $this->aula = $aula;
    }

    /**
     * @return mixed
     */
    public function getMateria()
    {
        return $this->materia;
    }

    /**
     * @return mixed
     */
    public function getAula()
    {
        return $this->aula;
    }

    /**
     * @param mixed $tempo_parada
     */
    public function setTempoParada($tempo_parada)
    {
        $this->tempo_parada = $tempo_parada;
    }

    /**
     * @param mixed $materia_status
     */
    public function setMateriaStatus($materia_status)
    {
        $this->materia_status = $materia_status;
    }

    /**
     * @param mixed $aula_status
     */
    public function setAulaStatus($aula_status)
    {
        $this->aula_status = $aula_status;
    }

    /**
     * @return mixed
     */
    public function getTempoParada()
    {
        return $this->tempo_parada;
    }

    /**
     * @return mixed
     */
    public function getMateriaStatus()
    {
        return $this->materia_status;
    }

    /**
     * @return mixed
     */
    public function getAulaStatus()
    {
        return $this->aula_status;
    }

    /**
     * @param mixed $aula_id
     */
    public function setAulaId($aula_id)
    {
        $this->aula_id = $aula_id;
    }

    /**
     * @return mixed
     */
    public function getAulaId()
    {
        return $this->aula_id;
    }

    /**
     * @param mixed $resumo
     */
    public function setResumo($resumo)
    {
        $this->resumo = $resumo;
    }

    /**
     * @return mixed
     */
    public function getResumo()
    {
        return $this->resumo;
    }
}