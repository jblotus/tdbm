<?php


namespace TheCodingMachine\TDBM\Utils;

use Doctrine\DBAL\Schema\Index;
use TheCodingMachine\TDBM\ConfigurationInterface;
use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\FileGenerator;
use Zend\Code\Generator\MethodGenerator;

class CodeGeneratorEventDispatcher implements CodeGeneratorListenerInterface
{
    /**
     * @var CodeGeneratorListenerInterface[]
     */
    private $listeners;

    /**
     * @param CodeGeneratorListenerInterface[] $listeners
     */
    public function __construct(array $listeners)
    {
        $this->listeners = $listeners;
    }

    public function onBaseBeanGenerated(FileGenerator $fileGenerator, BeanDescriptor $beanDescriptor, ConfigurationInterface $configuration): ?FileGenerator
    {
        foreach ($this->listeners as $listener) {
            $fileGenerator = $listener->onBaseBeanGenerated($fileGenerator, $beanDescriptor, $configuration);
            if ($fileGenerator === null) {
                break;
            }
        }
        return $fileGenerator;
    }

    public function onBaseBeanConstructorGenerated(MethodGenerator $methodGenerator, BeanDescriptor $beanDescriptor, ConfigurationInterface $configuration, ClassGenerator $classGenerator): ?MethodGenerator
    {
        foreach ($this->listeners as $listener) {
            $methodGenerator = $listener->onBaseBeanConstructorGenerated($methodGenerator, $beanDescriptor, $configuration, $classGenerator);
            if ($methodGenerator === null) {
                break;
            }
        }
        return $methodGenerator;
    }

    /**
     * Called when a column is turned into a getter/setter.
     *
     * @return array<int, ?MethodGenerator> Returns an array of 2 methods to be generated for this property. You MUST return the getter (first argument) and setter (second argument) as part of these methods (if you want them to appear in the bean). Return null if you want to delete them.
     */
    public function onBaseBeanPropertyGenerated(?MethodGenerator $getter, ?MethodGenerator $setter, AbstractBeanPropertyDescriptor $propertyDescriptor, BeanDescriptor $beanDescriptor, ConfigurationInterface $configuration, ClassGenerator $classGenerator): array
    {
        foreach ($this->listeners as $listener) {
            [$getter, $setter] = $listener->onBaseBeanPropertyGenerated($getter, $setter, $propertyDescriptor, $beanDescriptor, $configuration, $classGenerator);
            if ($getter === null && $setter === null) {
                break;
            }
        }
        return [$getter, $setter];
    }

    /**
     * Called when a foreign key from another table is turned into a "get many objects" method.
     *
     * @param MethodGenerator $getter
     * @param DirectForeignKeyMethodDescriptor $directForeignKeyMethodDescriptor
     * @param BeanDescriptor $beanDescriptor
     * @param ConfigurationInterface $configuration
     * @param ClassGenerator $classGenerator
     * @return MethodGenerator|null
     */
    public function onBaseBeanOneToManyGenerated(MethodGenerator $getter, DirectForeignKeyMethodDescriptor $directForeignKeyMethodDescriptor, BeanDescriptor $beanDescriptor, ConfigurationInterface $configuration, ClassGenerator $classGenerator): ?MethodGenerator
    {
        foreach ($this->listeners as $listener) {
            $getter = $listener->onBaseBeanOneToManyGenerated($getter, $directForeignKeyMethodDescriptor, $beanDescriptor, $configuration, $classGenerator);
            if ($getter === null) {
                break;
            }
        }
        return $getter;
    }

    /**
     * Called when a pivot table is turned into get/has/add/set/remove methods.
     *
     * @return array<int, ?MethodGenerator> Returns an array of methods to be generated for this property. You MUST return the get/has/add/set/remove methods as part of these methods (if you want them to appear in the bean).
     */
    public function onBaseBeanManyToManyGenerated(?MethodGenerator $getter, ?MethodGenerator $adder, ?MethodGenerator $remover, ?MethodGenerator $hasser, ?MethodGenerator $setter, PivotTableMethodsDescriptor $pivotTableMethodsDescriptor, BeanDescriptor $beanDescriptor, ConfigurationInterface $configuration, ClassGenerator $classGenerator): array
    {
        foreach ($this->listeners as $listener) {
            [$getter, $adder, $remover, $hasser, $setter] = $listener->onBaseBeanManyToManyGenerated($getter, $adder, $remover, $hasser, $setter, $pivotTableMethodsDescriptor, $beanDescriptor, $configuration, $classGenerator);
            if ($getter === null && $adder === null && $remover === null && $hasser === null && $setter === null) {
                break;
            }
        }
        return [$getter, $adder, $remover, $hasser, $setter];
    }

    public function onBaseBeanJsonSerializeGenerated(MethodGenerator $methodGenerator, BeanDescriptor $beanDescriptor, ConfigurationInterface $configuration, ClassGenerator $classGenerator): ?MethodGenerator
    {
        foreach ($this->listeners as $listener) {
            $methodGenerator = $listener->onBaseBeanJsonSerializeGenerated($methodGenerator, $beanDescriptor, $configuration, $classGenerator);
            if ($methodGenerator === null) {
                break;
            }
        }
        return $methodGenerator;
    }

    public function onBaseBeanCloneGenerated(MethodGenerator $methodGenerator, BeanDescriptor $beanDescriptor, ConfigurationInterface $configuration, ClassGenerator $classGenerator): ?MethodGenerator
    {
        foreach ($this->listeners as $listener) {
            $methodGenerator = $listener->onBaseBeanCloneGenerated($methodGenerator, $beanDescriptor, $configuration, $classGenerator);
            if ($methodGenerator === null) {
                break;
            }
        }
        return $methodGenerator;
    }

    public function onBaseDaoGenerated(FileGenerator $fileGenerator, BeanDescriptor $beanDescriptor, ConfigurationInterface $configuration): ?FileGenerator
    {
        foreach ($this->listeners as $listener) {
            $fileGenerator = $listener->onBaseDaoGenerated($fileGenerator, $beanDescriptor, $configuration);
            if ($fileGenerator === null) {
                break;
            }
        }
        return $fileGenerator;
    }

    public function onBaseDaoConstructorGenerated(MethodGenerator $methodGenerator, BeanDescriptor $beanDescriptor, ConfigurationInterface $configuration, ClassGenerator $classGenerator): ?MethodGenerator
    {
        foreach ($this->listeners as $listener) {
            $methodGenerator = $listener->onBaseDaoConstructorGenerated($methodGenerator, $beanDescriptor, $configuration, $classGenerator);
            if ($methodGenerator === null) {
                break;
            }
        }
        return $methodGenerator;
    }

    public function onBaseDaoSaveGenerated(MethodGenerator $methodGenerator, BeanDescriptor $beanDescriptor, ConfigurationInterface $configuration, ClassGenerator $classGenerator): ?MethodGenerator
    {
        foreach ($this->listeners as $listener) {
            $methodGenerator = $listener->onBaseDaoSaveGenerated($methodGenerator, $beanDescriptor, $configuration, $classGenerator);
            if ($methodGenerator === null) {
                break;
            }
        }
        return $methodGenerator;
    }

    public function onBaseDaoFindAllGenerated(MethodGenerator $methodGenerator, BeanDescriptor $beanDescriptor, ConfigurationInterface $configuration, ClassGenerator $classGenerator): ?MethodGenerator
    {
        foreach ($this->listeners as $listener) {
            $methodGenerator = $listener->onBaseDaoFindAllGenerated($methodGenerator, $beanDescriptor, $configuration, $classGenerator);
            if ($methodGenerator === null) {
                break;
            }
        }
        return $methodGenerator;
    }

    public function onBaseDaoGetByIdGenerated(MethodGenerator $methodGenerator, BeanDescriptor $beanDescriptor, ConfigurationInterface $configuration, ClassGenerator $classGenerator): ?MethodGenerator
    {
        foreach ($this->listeners as $listener) {
            $methodGenerator = $listener->onBaseDaoGetByIdGenerated($methodGenerator, $beanDescriptor, $configuration, $classGenerator);
            if ($methodGenerator === null) {
                break;
            }
        }
        return $methodGenerator;
    }

    public function onBaseDaoDeleteGenerated(MethodGenerator $methodGenerator, BeanDescriptor $beanDescriptor, ConfigurationInterface $configuration, ClassGenerator $classGenerator): ?MethodGenerator
    {
        foreach ($this->listeners as $listener) {
            $methodGenerator = $listener->onBaseDaoDeleteGenerated($methodGenerator, $beanDescriptor, $configuration, $classGenerator);
            if ($methodGenerator === null) {
                break;
            }
        }
        return $methodGenerator;
    }

    public function onBaseDaoFindGenerated(MethodGenerator $methodGenerator, BeanDescriptor $beanDescriptor, ConfigurationInterface $configuration, ClassGenerator $classGenerator): ?MethodGenerator
    {
        foreach ($this->listeners as $listener) {
            $methodGenerator = $listener->onBaseDaoFindGenerated($methodGenerator, $beanDescriptor, $configuration, $classGenerator);
            if ($methodGenerator === null) {
                break;
            }
        }
        return $methodGenerator;
    }

    public function onBaseDaoFindFromSqlGenerated(MethodGenerator $methodGenerator, BeanDescriptor $beanDescriptor, ConfigurationInterface $configuration, ClassGenerator $classGenerator): ?MethodGenerator
    {
        foreach ($this->listeners as $listener) {
            $methodGenerator = $listener->onBaseDaoFindFromSqlGenerated($methodGenerator, $beanDescriptor, $configuration, $classGenerator);
            if ($methodGenerator === null) {
                break;
            }
        }
        return $methodGenerator;
    }

    public function onBaseDaoFindFromRawSqlGenerated(MethodGenerator $methodGenerator, BeanDescriptor $beanDescriptor, ConfigurationInterface $configuration, ClassGenerator $classGenerator): ?MethodGenerator
    {
        foreach ($this->listeners as $listener) {
            $methodGenerator = $listener->onBaseDaoFindFromRawSqlGenerated($methodGenerator, $beanDescriptor, $configuration, $classGenerator);
            if ($methodGenerator === null) {
                break;
            }
        }
        return $methodGenerator;
    }

    public function onBaseDaoFindOneGenerated(MethodGenerator $methodGenerator, BeanDescriptor $beanDescriptor, ConfigurationInterface $configuration, ClassGenerator $classGenerator): ?MethodGenerator
    {
        foreach ($this->listeners as $listener) {
            $methodGenerator = $listener->onBaseDaoFindOneGenerated($methodGenerator, $beanDescriptor, $configuration, $classGenerator);
            if ($methodGenerator === null) {
                break;
            }
        }
        return $methodGenerator;
    }

    public function onBaseDaoFindOneFromSqlGenerated(MethodGenerator $methodGenerator, BeanDescriptor $beanDescriptor, ConfigurationInterface $configuration, ClassGenerator $classGenerator): ?MethodGenerator
    {
        foreach ($this->listeners as $listener) {
            $methodGenerator = $listener->onBaseDaoFindOneFromSqlGenerated($methodGenerator, $beanDescriptor, $configuration, $classGenerator);
            if ($methodGenerator === null) {
                break;
            }
        }
        return $methodGenerator;
    }

    public function onBaseDaoSetDefaultSortGenerated(MethodGenerator $methodGenerator, BeanDescriptor $beanDescriptor, ConfigurationInterface $configuration, ClassGenerator $classGenerator): ?MethodGenerator
    {
        foreach ($this->listeners as $listener) {
            $methodGenerator = $listener->onBaseDaoSetDefaultSortGenerated($methodGenerator, $beanDescriptor, $configuration, $classGenerator);
            if ($methodGenerator === null) {
                break;
            }
        }
        return $methodGenerator;
    }

    public function onBaseDaoFindByIndexGenerated(MethodGenerator $methodGenerator, Index $index, BeanDescriptor $beanDescriptor, ConfigurationInterface $configuration, ClassGenerator $classGenerator): ?MethodGenerator
    {
        foreach ($this->listeners as $listener) {
            $methodGenerator = $listener->onBaseDaoFindByIndexGenerated($methodGenerator, $index, $beanDescriptor, $configuration, $classGenerator);
            if ($methodGenerator === null) {
                break;
            }
        }
        return $methodGenerator;
    }

    /**
     * @param BeanDescriptor[] $beanDescriptors
     */
    public function onDaoFactoryGenerated(FileGenerator $fileGenerator, array $beanDescriptors, ConfigurationInterface $configuration): ?FileGenerator
    {
        foreach ($this->listeners as $listener) {
            $fileGenerator = $listener->onDaoFactoryGenerated($fileGenerator, $beanDescriptors, $configuration);
            if ($fileGenerator === null) {
                break;
            }
        }
        return $fileGenerator;
    }

    /**
     * @param BeanDescriptor[] $beanDescriptors
     */
    public function onDaoFactoryConstructorGenerated(MethodGenerator $methodGenerator, array $beanDescriptors, ConfigurationInterface $configuration, ClassGenerator $classGenerator): ?MethodGenerator
    {
        foreach ($this->listeners as $listener) {
            $methodGenerator = $listener->onDaoFactoryConstructorGenerated($methodGenerator, $beanDescriptors, $configuration, $classGenerator);
            if ($methodGenerator === null) {
                break;
            }
        }
        return $methodGenerator;
    }

    public function onDaoFactoryGetterGenerated(MethodGenerator $methodGenerator, BeanDescriptor $beanDescriptor, ConfigurationInterface $configuration, ClassGenerator $classGenerator): ?MethodGenerator
    {
        foreach ($this->listeners as $listener) {
            $methodGenerator = $listener->onDaoFactoryGetterGenerated($methodGenerator, $beanDescriptor, $configuration, $classGenerator);
            if ($methodGenerator === null) {
                break;
            }
        }
        return $methodGenerator;
    }

    public function onDaoFactorySetterGenerated(MethodGenerator $methodGenerator, BeanDescriptor $beanDescriptor, ConfigurationInterface $configuration, ClassGenerator $classGenerator): ?MethodGenerator
    {
        foreach ($this->listeners as $listener) {
            $methodGenerator = $listener->onDaoFactorySetterGenerated($methodGenerator, $beanDescriptor, $configuration, $classGenerator);
            if ($methodGenerator === null) {
                break;
            }
        }
        return $methodGenerator;
    }
}
